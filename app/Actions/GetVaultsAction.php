<?php

namespace App\Actions;

use App\Contracts\GatActionInterface;
use App\Contracts\QueryInterface;
use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class GetVaultsAction implements GatActionInterface
{
    public function handle(QueryInterface $query): JsonResponse
    {
        return response()->json(
            Vault::filterBySearch($query->getParameter('search'))
                ->orderBy('created_at', 'desc')
                ->paginate()
        );
    }
}
