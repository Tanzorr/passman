<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property int $is_shared
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vault newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vault newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vault query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereIsShared($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vault whereUserId($value)
 * @mixin \Eloquent
 */
class Vault extends Model
{
    use HasFactory;

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }

    public function sharedAccess(): MorphMany
    {
        return $this->morphMany(SharedAccess::class, 'accessible');
    }

}
