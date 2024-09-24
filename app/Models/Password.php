<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'vault_id',
        'name',
        'value',
        'description',
    ];

    public function sharedAccess(): MorphMany
    {
        return $this->morphMany(SharedAccess::class, 'accessible');
    }

    public function vault(): BelongsTo
    {
        return $this->belongsTo(Vault::class);
    }
}
