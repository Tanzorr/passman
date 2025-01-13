<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;

class AuthController extends Controller
{
    /**
     */
    public function login(LoginUserRequest $request, LoginAction $loginAction): JsonResponse
    {
        return response()->json($loginAction->handle($request), 200);
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
