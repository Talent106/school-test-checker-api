<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'test_id' => $this->test_id,
            'identifier' => $this->identifier,
            'caption' => $this->caption,
            'description' => $this->description,
            'grade_credit' => $this->grade_credit,
            'testQuestionOptions' => TestQuestionOptionResource::collection($this->testQuestionOptions),
        ];
    }
}
