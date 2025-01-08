<?php

namespace App\Traits;

use App\Models\Password;
use App\Models\User;
use App\Models\Vault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ResolvesEntities
{
    public array $entityMap = [
        'vault' => Vault::class,
        'password' => Password::class,
        'user' => User::class,
    ];

    public function resolveEntity(string $entityType, int $entityId): Model
    {
        if (! array_key_exists($entityType, $this->entityMap)) {
            throw new ModelNotFoundException('Entity type not recognized.');
        }

        $entityClass = $this->entityMap[$entityType];

        return $entityClass::findOrFail($entityId);
    }
}
