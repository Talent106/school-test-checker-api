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
        $options = is_array($data->get('test_question_options'))
            ? Collection::make($data->get('test_question_options'))
            : $data->get('test_question_options');

        return new self(
            id: (int) $data->get('id') ?: null,
            test_id: (int) $data->get('test_id'),
            identifier: (string) $data->get('identifier'),
            caption: (string) $data->get('caption'),
            description: (string) $data->get('description'),
            grade_credit: (float) $data->get('grade_credit'),
            test_question_options: TestQuestionOptionDTO::createFromMany($options),
        );
    }
}
