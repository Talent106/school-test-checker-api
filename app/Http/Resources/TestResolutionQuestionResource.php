<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResolutionQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'test_resolution_id' => $this->test_resolution_id,
            'test_question_id' => $this->test_question_id,
            'answer' => $this->answer,
            'is_correct' => $this->is_correct,
            'extracted_text' => $this->extracted_text,
            'testQuestion' => TestQuestionResource::make($this->testQuestion),
        ];
    }
}
