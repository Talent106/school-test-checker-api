<?php

namespace App\Models;

use App\Base\BaseModel;
use Carbon\Traits\Cast;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Test
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property string $name
 * @property int $grade
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestQuestion> $testQuestions
 * @method static \Illuminate\Database\Eloquent\Builder|Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Test withoutTrashed()
 * @mixin \Eloquent
 */
class Test extends BaseModel
{
    use CascadeSoftDeletes;

    protected $cascadeDeletes = ['testQuestions'];

    protected $fillable = [
        'name',
        'course_id',
        'grade',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function testQuestions(): HasMany
    {
        return $this->hasMany(TestQuestion::class);
    }
}
