<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Enum\TestResolutionStatusEnum;
use App\Traits\HasAttachments;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TestResolution
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property int $student_id
 * @property float $grade
 * @property TestResolutionStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\Test $test
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attachment> $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestResolutionQuestion> $testResolutionQuestions
 * @property-read int|null $attachments_count
 * @property-read int|null $test_resolution_questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TestResolution whereStatus($value)
 * @mixin \Eloquent
 */
class TestResolution extends BaseModel
{
    use CascadeSoftDeletes;
    use HasAttachments;

    public $casts = [
        'status' => TestResolutionStatusEnum::class
    ];

    protected $cascadeDeletes = ['testResolutionQuestions'];

    protected $fillable = [
        'test_id',
        'user_id',
        'student_id',
        'grade',
        'status',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function testResolutionQuestions(): HasMany
    {
        return $this->hasMany(TestResolutionQuestion::class);
    }
}
