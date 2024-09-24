<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SharedAccess extends Model
{
    use HasFactory;

    const VAULT_TYPE = 'App\\Models\\Vault';

    const ACCESS_TYPE_MAP = [
        'vault' => 'App\\Models\\Vault',
        'password' => 'App\\Models\\Password',
    ];

    protected $fillable = [
        'accessible_type',
        'accessible_id',
        'user_id',
        'access_level',
        'expires_at',
    ];

    public function accessible(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
