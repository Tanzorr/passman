<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function upload(UploadedFile $file, string $entityType, int $entityId): string
    {
        $fileHash = hash_file('sha256', $file->getRealPath());

        $existingImage = Image::where('hash', $fileHash)->first();
        $currentImage = Image::where('entity_id', $entityId)->where('entity_type', $entityType)->first();
        if ($existingImage) {
            return $existingImage->path;
        }

        if ($currentImage) {
            $currentImage->delete();
            Storage::disk('public')->delete('storage/'.$currentImage->name);
        }

        $fileName = $file->getClientOriginalName();
        $path = config('app.url').'/storage/'.$file->storeAs('uploads', $fileName, 'public');

        Image::create([
            'hash' => $fileHash,
            'name' => $fileName,
            'path' => $path,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
        ]);

        return $path;
    }

    public function delete(string $imageName, string $entity, string $entityId): void
    {
        if (Storage::disk('public')->exists($imageName)) {
            Storage::disk('public')->delete($imageName);
        }

        Image::where('path', $imageName)->delete();
    }
}
