<?php

namespace App\Models;

use App\Base\BaseModel;
use Carbon\Carbon;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * App\Models\TestQuestion
 *
 * @property int $id
 * @property int $test_id
 * @property string $identifier
 * @property string $caption
 * @property string $description
 * @property float $grade_credit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Test $test
 * @property-read TestQuestionOption|null $correctOption
 * @property-read Collection<int, TestQuestionOption> $testQuestionOptions
 * @mixin \Eloquent
 */
class TestQuestion extends BaseModel
{
    use CascadeSoftDeletes;

    public static bool $belongsToUser = false;

    protected $cascadeDeletes = ['testQuestionOptions'];

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

    public function correctOption(): HasOne
    {
        return $this->hasOne(TestQuestionOption::class)->ofMany(
            ['id' => 'max'],
            fn (Builder $query) => $query->where('is_correct', true)
        );
    }

    public function testQuestionOptions(): HasMany
    {
        return $this->hasMany(TestQuestionOption::class);
    }
}
