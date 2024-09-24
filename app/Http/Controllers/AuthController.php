<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();

        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['authToken' => $token, 'loggedUser' => $user]);
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(): JsonResponse
    {
        Session::get('user')?->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
