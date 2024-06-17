<?php

namespace App\Base;

use App\Models\User;
use App\Scopes\BelongsToUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Base\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use SoftDeletes;

    public static bool $belongsToUser = true;

    public static function booted(): void
    {
        static::creating(function ($model): void {
            if (static::$belongsToUser) {
                $model->update(['user_id' => User::getAuthenticated()->id]);
            }
        });

        static::addGlobalScope(new BelongsToUserScope());
    }
}
