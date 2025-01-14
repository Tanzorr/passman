<?php

namespace App\Actions;

use App\Contracts\ReadActionInterface;
use App\Contracts\QueryInterface;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class GetUsersAction implements ReadActionInterface
{
    public function handle(QueryInterface $query): mixed
    {
        return User::filterBySearch($query->get('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
