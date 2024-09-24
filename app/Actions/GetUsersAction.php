<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class GetUsersAction
{
    public function handle($search): JsonResponse
    {
        return response()->json(
            User::filterBySearch($search)
                ->orderBy('created_at', 'desc')
                ->paginate()
        );
    }
}
