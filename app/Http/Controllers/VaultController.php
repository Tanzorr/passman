<?php

namespace App\Http\Controllers;

use App\Models\Vault;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Vault::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Vault::create($request->all());

        return response()->json(['message' => 'Vault created successfully'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required | string | min:2 | max:255 | unique:vaults',
            'description' => 'nullable',
        ]);

        Vault::create($request->all());

        return response()->json(['message' => 'Vault created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vault $vault): Vault
    {
        return $vault;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vault $vault)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vault $vault)
    {
        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Vault::where('id', $request->id)->update($request->all());

        return response()->json(['message' => 'Vault updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vault $vault)
    {
        if($vault->delete()){
            return response(null, 200);
        }

        return response(null, 404);
    }
}
