<?php

namespace App\DTO;

use App\Base\BaseDTO;
use Illuminate\Support\Collection;

class TestDTO extends BaseDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public int $course_id,
        public int $grade,
        public Collection $test_questions,
    ) {
    }

    public static function createFromCollection(Collection $data): self
    {
        return new self(
            id: (int) $data->get('id') ?? null,
            course_id: (int) $data->get('course_id'),
            name: (string) $data->get('name'),
            grade: (int) $data->get('grade'),
            test_questions: TestQuestionDTO::createFromMany($data->get('test_questions')),
        );
    }
}
