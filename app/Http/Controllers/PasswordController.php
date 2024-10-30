<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Password::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request):JsonResponse
    {
        $request->validate([
            'vault_id' => 'required',
            'name' => 'required',
            'value' => 'required',
            'description' => 'nullable',
        ]);

        Password::create($request->all());

        return response()->json(['message' => 'Password created successfully'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'vault_id' => 'required',
            'name' => 'required',
            'value' => 'required',
            'description' => 'nullable',
        ]);

        Password::wehere('id', $request->id)->update($request->all());

        return response()->json(['message' => 'Password updated successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Password $password): Password
    {
        return $password;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Password $password)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Password $password)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password): JsonResponse
    {
        $password->delete();

        return response()->json(['message' => 'Password deleted successfully']);
    }
}
