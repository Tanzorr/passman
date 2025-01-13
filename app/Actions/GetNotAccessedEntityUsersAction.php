<?php

namespace App\Actions;

use App\Contracts\MutationActionInterface;
use App\Contracts\MutationInterface;
use App\Contracts\QueryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class GetNotAccessedEntityUsersAction
{
    public function handle(QueryInterface $query, Collection $accessedEntityUserIds): Collection
    {
        return User::filterBySearch($query->getParameter('search'))
            ->whereNotIn('id', $accessedEntityUserIds)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}
