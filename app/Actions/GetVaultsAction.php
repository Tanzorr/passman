<?php

namespace App\Actions;

use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class GetVaultsAction
{
    public function handle($search): JsonResponse
    {
        return response()->json(
            Vault::filterBySearch($search)
                ->orderBy('created_at', 'desc')
                ->paginate()
        );
    }
}
