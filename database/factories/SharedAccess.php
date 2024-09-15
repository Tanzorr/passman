<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 *
 *
 * @property int $id
 * @property string $shareable_type
 * @property int $shareable_id
 * @property int $user_id
 * @property int|null $access_level
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereAccessLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereShareableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereShareableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedAccess whereUserId($value)
 * @mixin \Eloquent
 */
class SharedAccess extends Model
{
    use HasFactory;


    public function accessible(): MorphTo
    {
        return $this->morphTo();
    }
}
