<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::all()->sortByDesc('created_at');

        return response()->json(['medias' => $medias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');

        $existingMedia = Media::where('user_id', auth()->id())
            ->where('file_name', $file->getClientOriginalName())
            ->first();

        if ($existingMedia) {
            return response()->json(['media' => $existingMedia, 'message' => 'File already exists'], 200);
        }

        $path = $file->store('uploads', 'public');

        $media = Media::create([
            'user_id' => auth()->id(),
            'file_path' => config('app.url').'/'.$path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

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
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $filePath = str_replace(config('app.url').'/', '', $media->file_path);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $media->delete();

        return response()->json(['message' => 'Media deleted successfully'], 200);
    }
}
