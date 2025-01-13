<?php

namespace App\Actions;

use App\Contracts\MutationActionInterface;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Support\Facades\Auth;

class LoginAction implements MutationActionInterface
{
    public function handle(ValidatesWhenResolved $request, $id = ''): mixed
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return [
            'authToken' => $user->createToken('api-token')->plainTextToken,
            'loggedUser' => $user,
        ];
    }
}
