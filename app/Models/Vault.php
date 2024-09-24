<?php

namespace App\Models;

use App\Scopes\UserVaultScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Vault extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_shared',
    ];

    public function scopeFilterBySearch(Builder $query, $search = ''): Builder
    {
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
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

    public function accessedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shared_accesses', 'accessible_id', 'user_id')
            ->where('accessible_type', SharedAccess::VAULT_TYPE)
            ->select(['users.*', 'shared_accesses.id as shared_access_id']);
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
