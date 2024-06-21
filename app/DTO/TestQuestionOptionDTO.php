<?php

namespace App\DTO;

use App\Base\BaseDTO;
use Illuminate\Support\Collection;

class TestQuestionOptionDTO extends BaseDTO
{
    public function __construct(
        public ?int $id,
        public ?int $test_question_id,
        public string $identifier,
        public string $description,
        public bool $is_correct,
    ) {
    }

    public static function createFromCollection(Collection $data): self
    {
        return new self(
            id: (int) $data->get('id') ?: null,
            test_question_id: (int) $data->get('test_question_id') ?: null,
            identifier: (string) $data->get('identifier'),
            description: (string) $data->get('description'),
            is_correct: (bool) $data->get('is_correct'),
        );
    }
}
