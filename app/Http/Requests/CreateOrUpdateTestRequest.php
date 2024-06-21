<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'sometimes|nullable|integer',
            'course_id' => 'required|integer',
            'name' => 'required|string',
            'grade' => 'required|integer',

            'test_questions' => 'required|array',
            'test_questions.*.id' => 'sometimes|nullable|integer',
            'test_questions.*.test_id' => 'sometimes|nullable|integer',
            'test_questions.*.caption' => 'required|string',
            'test_questions.*.description' => 'required|string',
            'test_questions.*.grade_credit' => 'required|numeric',

            'test_questions.*.test_question_options' => 'required|array',
            'test_questions.*.test_question_options.*.id' => 'sometimes|nullable|integer',
            'test_questions.*.test_question_options.*.test_question_id' => 'sometimes|nullable|integer',
            'test_questions.*.test_question_options.*.identifier' => 'required|string',
            'test_questions.*.test_question_options.*.description' => 'required|string',
            'test_questions.*.test_question_options.*.is_correct' => 'sometimes|nullable|boolean',
        ];
    }
}
