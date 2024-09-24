<?php

namespace App\Services;

use App\Models\SharedAccess;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class SharedAccessService
{
    public function getNotAccessedUsers(string $accessibleType, string $accessibleId, $search = ''): JsonResponse
    {
        $userIds = $this->getSharedAccess($accessibleType, $accessibleId);
        $users = User::whereNotIn('id', $userIds)
            ->filterBySearch($search)
            ->take(5)
            ->get();

        return response()->json($users);
    }

    private function getSharedAccess(string $accessibleType, string $accessibleId): Collection
    {
        return SharedAccess::where('accessible_type', $accessibleType)
            ->where('accessible_id', $accessibleId)
            ->pluck('user_id');
    }
}
