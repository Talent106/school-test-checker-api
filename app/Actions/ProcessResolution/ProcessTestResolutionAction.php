<?php

namespace App\Actions\ProcessResolution;

use App\Models\TestQuestion;
use App\Models\TestQuestionOption;
use App\Models\TestResolution;
use App\Models\TestResolutionQuestion;

class ProcessTestResolutionAction
{
    public static function execute(TestResolution $testResolution): void
    {
        $extractedQuestions = ExtractQuestionsFromTestResolutionAttachmentsAction::execute($testResolution);
        $testResolution->testResolutionQuestions()->delete();

        /** @var TestQuestion $testQuestion */
        foreach ($testResolution->test->testQuestions as $testQuestion) {
            $extractedQuestion = $extractedQuestions->first(
                fn (string $question) => str_contains($question, "#{$testQuestion->id}#")
                    || str_contains($question, "{$testQuestion->identifier}-")
                    || str_contains($question, "{$testQuestion->identifier} -")
            );

            if (!$extractedQuestion) {
                continue;
            }

            $hasCheckedCorrectOption = !str_contains($extractedQuestion, "({$testQuestion->correctOption->identifier})");
            $checkedOption = $hasCheckedCorrectOption
                ? $testQuestion->correctOption
                : $testQuestion->testQuestionOptions->first(fn (TestQuestionOption $option) => !str_contains($extractedQuestion, "({$option->identifier})"));

            $testResolution->testResolutionQuestions()->create([
                'test_question_id' => $testQuestion->id,
                'answer' => $checkedOption?->identifier,
                'is_correct' => $checkedOption?->is_correct ?? false,
            ]);

            $extractedQuestions = $extractedQuestions->reject(fn (string $question) => $question === $extractedQuestion);
        }

        $testResolution->update([
            'grade' => $testResolution->testResolutionQuestions()->where('is_correct', true)->get()->reduce(
                fn (float $carry, TestResolutionQuestion $question): float => $carry + $question->testQuestion->grade_credit,
                0
            )
        ]);
    }
}
