<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResolutionResource extends JsonResource
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
            'test_id' => $this->test_id,
            'user_id' => $this->user_id,
            'student_id' => $this->student_id,
            'grade' => $this->grade,
            'status' => $this->status,
            'student' => StudentResource::make($this->student),
            'test' => TestResource::make($this->test),
            'testResolutionQuestions' => TestResolutionQuestionResource::collection($this->testResolutionQuestions),
        ];
    }
}
