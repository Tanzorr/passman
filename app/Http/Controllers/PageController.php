<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Page created successfully',
            'user' => Page::create(array_merge(
                $request->all(),
                ['author_id' => auth()->id()]
            )),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page): JsonResponse
    {
        return response()->json($page);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page): JsonResponse
    {
        return response()->json([
            'message' => 'Page updated successfully',
            'user' => $page->update($request->all()), 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): JsonResponse
    {
        return response()->json(null, $page->delete() ? 200 : 404);
    }
}
