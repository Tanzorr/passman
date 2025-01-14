<?php

namespace App\Actions;

use App\Contracts\QueryInterface;
use App\Contracts\ReadActionInterface;
use Illuminate\Support\Facades\Auth;

class LoginAction implements ReadActionInterface
{
    public function handle(QueryInterface $query): array|false
    {
        if (! Auth::attempt($query->get('credentials'))) {
            return false;
        }
        $user = Auth::user();
        if (! $user) {
            return false;
        }

        return [
            'authToken' => $user->createToken('api-token')->plainTextToken,
            'loggedUser' => $user,
        ];
    }
}
