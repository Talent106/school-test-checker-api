<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TestQuestion
 *
 * @property int $id
 * @property int $test_id
 * @property string $identifier
 * @property string $caption
 * @property string $description
 * @property float $grade_credit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Test $test
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereGradeCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestQuestion withoutTrashed()
 * @mixin \Eloquent
 */
class TestQuestion extends BaseModel
{
    public static bool $belongsToUser = false;

    protected $fillable = [
        'test_id',
        'identifier',
        'caption',
        'description',
        'grade_credit',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function testQuestionOptions(): HasMany
    {
        return $this->hasMany(TestQuestionOption::class);
    }
}
