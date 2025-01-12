<?php

namespace App\Actions;

use App\Contracts\QueryInterface;
use App\Models\User;

class GetUsersAction
{
    public function handle(QueryInterface $query)
    {
        $users = User::filterBySearch($query->getParameter('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();

        return $users;
    }
}
