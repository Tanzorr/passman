<?php

namespace App\Actions;

use App\Contracts\QueryInterface;
use App\Contracts\ReadActionInterface;
use App\Models\Vault;
use Illuminate\Pagination\LengthAwarePaginator;

class GetVaultsAction implements ReadActionInterface
{
    public function handle(QueryInterface $query): LengthAwarePaginator
    {
        return Vault::filterBySearch($query->get('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
