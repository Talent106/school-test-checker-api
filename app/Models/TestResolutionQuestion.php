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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\TestQuestion $testQuestion
 * @property-read \App\Models\TestResolution $testResolution
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereTestQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereTestResolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolutionQuestion withoutTrashed()
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
