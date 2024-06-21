<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestQuestionOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'test_question_id' => $this->test_question_id,
            'identifier' => $this->identifier,
            'description' => $this->description,
            'is_correct' => $this->is_correct,
        ];
    }
}
