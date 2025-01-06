<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaService
{
    /**
     * Get all media for the authenticated user.
     */
    public function getAllUserMedia($search = '')
    {
        $userId = Auth::id();

        return Media::where('user_id', $userId)
            ->where('mime_type', 'like', 'image/%')
            ->filterBySearch($search)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    /**
     * Store a new media file.
     */
    public function storeMedia($file, int $userId)
    {
        $existingMedia = Media::whereUserId($userId)
            ->where('file_name', $file->getClientOriginalName())
            ->first();

        if ($existingMedia) {
            return $existingMedia;
        }

        $path = $file->store('uploads', 'public');

        return Media::create([
            'user_id' => $userId,
            'file_path' => config('app.url').'/storage/'.$path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Delete a media file.
     */
    public function deleteMedia(Media $media)
    {
        if (\Storage::disk('public')->exists(str_replace(config('app.url').'/storage/', '', $media->file_path))) {
            \Storage::disk('public')->delete(str_replace(config('app.url').'/storage/', '', $media->file_path));
        }

        $media->delete();
    }
}
