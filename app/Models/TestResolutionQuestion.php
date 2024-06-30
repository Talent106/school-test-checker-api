<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TestResolutionQuestion
 *
 * @property int $id
 * @property int $test_resolution_id
 * @property int $test_question_id
 * @property string $answer
 * @property bool $is_correct
 * @property string|null $extracted_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read TestQuestion $testQuestion
 * @property-read TestResolution $testResolution
 * @mixin \Eloquent
 */
class TestResolutionQuestion extends BaseModel
{
    public static bool $belongsToUser = false;

    protected $fillable = [
        'test_resolution_id',
        'test_question_id',
        'answer',
        'is_correct',
        'extracted_text',
    ];

    public function testResolution(): BelongsTo
    {
        return $this->belongsTo(TestResolution::class);
    }

    public function testQuestion(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class);
    }
}
