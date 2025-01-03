<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        return response()->json($this->mediaService->getAllUserMedia($search));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request): JsonResponse
    {
        $request->validated();

        $file = $request->file('file');

        $media = $this->mediaService->storeMedia($file, auth()->id());

        return response()->json(['media' => $media], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        return response()->json(['media' => $media]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {

        $this->authorizeMediaAccess($media);

        $this->mediaService->deleteMedia($media);

        return response()->json(['message' => 'Media deleted successfully'], 200);
    }

    /**
     * Authorize media access for the current user.
     */
    private function authorizeMediaAccess(Media $media)
    {
        if ($media->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to media');
        }
    }
}
