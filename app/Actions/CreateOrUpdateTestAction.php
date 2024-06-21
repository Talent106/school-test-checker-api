<?php

namespace App\Actions;

use App\DTO\TestDTO;
use App\DTO\TestQuestionDTO;
use App\DTO\TestQuestionOptionDTO;
use App\Models\Test;
use App\Models\TestQuestion;

class CreateOrUpdateTestAction
{
    public static function execute(TestDTO $testDTO): Test
    {
        /** @var Test $test */
        $test = Test::updateOrCreate(
            $testDTO->only(['id'])->toArray(),
            $testDTO->except(['test_questions', 'id'])->toArray()
        );
        $processedQuestionIds = [];

        /** @var TestQuestionDTO $questionDTO */
        foreach ($testDTO->test_questions as $questionDTO) {
            /** @var TestQuestion $question */
            $question = $test->testQuestions()->updateOrCreate(
                $questionDTO->only(['id'])->toArray(),
                $questionDTO->except(['test_question_options', 'id', 'test_question_id'])->toArray()
            );

            $processedQuestioOptionIds = $questionDTO->test_question_options->map(
                fn (TestQuestionOptionDTO $optionDTO) => $question->testQuestionOptions()->updateOrCreate(
                    $optionDTO->only(['id'])->toArray(),
                    $optionDTO->except(['id', 'test_question_id'])->toArray()
                )->id
            );

            $question->testQuestionOptions()->whereNotIn('id', $processedQuestioOptionIds)->delete();
            $processedQuestionIds[] = $question->id;
        }

        $test->testQuestions()->whereNotIn('id', $processedQuestionIds)->delete();
        $test->refresh();

        return $test;
    }
}
