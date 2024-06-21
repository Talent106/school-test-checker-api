<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TestQuestionOption
 *
 * @property int $id
 * @property int $test_question_id
 * @property string $identifier
 * @property string $description
 * @property int $is_correct
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\TestQuestion $testQuestion
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereTestQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestionOption withoutTrashed()
 * @mixin \Eloquent
 */
class TestQuestionOption extends BaseModel
{
    public static bool $belongsToUser = false;

    protected $fillable = [
        'test_question_id',
        'identifier',
        'description',
        'is_correct',
    ];

    public function testQuestion(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class);
    }
}
