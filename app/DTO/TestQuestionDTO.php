<?php

namespace App\DTO;

use App\Base\BaseDTO;
use Illuminate\Support\Collection;

class TestQuestionDTO extends BaseDTO
{
    public function __construct(
        public ?int $id,
        public ?int $test_id,
        public string $identifier,
        public string $caption,
        public string $description,
        public float $grade_credit,
        public Collection $test_question_options,
    ) {
    }

    public static function createFromCollection(Collection $data): self
    {
        return new self(
            id: (int) $data->get('id') ?: null,
            test_id: (int) $data->get('test_id'),
            identifier: (string) $data->get('identifier'),
            caption: (string) $data->get('caption'),
            description: (string) $data->get('description'),
            grade_credit: (float) $data->get('grade_credit'),
            test_question_options: TestQuestionOptionDTO::createFromMany($data->get('options')),
        );
    }
}
