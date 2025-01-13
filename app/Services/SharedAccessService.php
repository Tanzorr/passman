<?php

namespace App\Services;

use App\Models\SharedAccess;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class SharedAccessService
{
    public function getSharedEntityAccessUserIds(string $accessibleType, string $accessibleId): Collection
    {
        return SharedAccess::where('accessible_type', $accessibleType)
            ->where('accessible_id', $accessibleId)
            ->pluck('user_id');
    }
}
