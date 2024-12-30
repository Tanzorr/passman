<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    /**
     * Get all media for the authenticated user.
     */
    public function getAllUserMedia(int $userId)
    {
        return Media::whereUserId($userId)->get();
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
            'file_path' => config('app.url').'/'.$path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Delete a media file.
     */
    public function deleteMedia(Media $media): void
    {
        $filePath = str_replace(config('app.url').'/', '', $media->file_path);

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $media->delete();
    }
}
