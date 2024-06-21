<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'course_id' => $this->course_id,
            'grade' => $this->grade,
            'course' => CourseResource::make($this->course),
            'testQuestions' => TestQuestionResource::collection($this->testQuestions),
        ];
    }
}
