<?php

namespace App\Actions;

use App\Contracts\GatActionInterface;
use App\Contracts\QueryInterface;
use App\Models\User;

class GetUsersAction implements GatActionInterface
{
    public function handle(QueryInterface $query): mixed
    {
        return User::filterBySearch($query->getParameter('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
