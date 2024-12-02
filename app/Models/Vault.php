<?php

namespace App\Models;

use App\Scopes\UserVaultScope;
use Database\Factories\SharedAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property int $is_shared
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Vault newModelQuery()
 * @method static Builder|Vault newQuery()
 * @method static Builder|Vault query()
 * @method static Builder|Vault whereCreatedAt($value)
 * @method static Builder|Vault whereDescription($value)
 * @method static Builder|Vault whereId($value)
 * @method static Builder|Vault whereIsShared($value)
 * @method static Builder|Vault whereName($value)
 * @method static Builder|Vault whereUpdatedAt($value)
 * @method static Builder|Vault whereUserId($value)
 * @method static filterBySearch(mixed $search)
 *
 * @mixin \Eloquent
 */
class Vault extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_shared',
    ];

    /**
     * Scope for filtering vaults by a search query.
     *
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    public function scopeFilterBySearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }

    public function sharedAccess(): MorphMany
    {
        return $this->morphMany(SharedAccess::class, 'accessible');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new UserVaultScope);
    }
}
