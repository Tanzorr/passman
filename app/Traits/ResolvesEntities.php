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

    public function resolveEntity(string $mediableType, int $mediableId): Model
    {
        if (! array_key_exists($mediableType, $this->entityMap)) {
            throw new ModelNotFoundException('Entity type not recognized.');
        }

        $entityClass = $this->entityMap[$mediableType];

        return $entityClass::findOrFail($mediableId);
    }
}
