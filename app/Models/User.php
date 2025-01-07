<?php

namespace App\Models;

use App\Scopes\UserVaultScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['ownVaults',  'media'];

    public function scopeFilterBySearch(Builder $query, $search = ''): Builder
    {
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        return $query;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function vaults(): HasMany
    {
        return $this->hasMany(Vault::class)->withoutGlobalScope(UserVaultScope::class);
    }

    public function sharedVaultsRelation(): HasManyThrough
    {
        return $this->hasManyThrough(
            Vault::class,
            SharedAccess::class,
            'user_id',
            'id',
            'id',
            'accessible_id'
        )
            ->where('shared_accesses.accessible_type', Vault::class)
            ->addSelect([
                'vaults.*',
                'shared_accesses.user_id as shared_user_id',
                'shared_accesses.id as shared_access_id',
            ]);
    }

    public function getOwnVaultsAttribute(): Collection
    {
        return $this->vaults()->get();
    }

    public function getSharedVaultsAttribute()
    {
        return $this->sharedVaultsRelation()->get();
    }

    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable', 'media_relations');
    }

    public function getMediaAttribute()
    {
        return $this->media()->get();
    }
}
