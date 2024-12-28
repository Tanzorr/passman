<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function upload(UploadedFile $file, string $entityType, int $entityId): string
    {
        $currentImage = Image::where('entity_id', $entityId)->where('entity_type', $entityType)->first();
        if ($currentImage) {
            $currentImageUsed = Image::where('name', $currentImage->name)->count() > 1;
            if (! $currentImageUsed) {
                Storage::disk('public')->delete('uploads/'.$currentImage->name);
                $currentImage->delete();
            }
        }

        $fileName = $file->getClientOriginalName();
        $existingImage = Image::where('name', $fileName)->first();

        if ($existingImage) {
            $path = $existingImage->path;

            Image::create([
                'name' => $fileName,
                'path' => $path,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
            ]);
        } else {
            $path = config('app.url').'/storage/'.$file->storeAs('uploads', $fileName, 'public');

            Image::create([
                'name' => $fileName,
                'path' => $path,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
            ]);
        }
        return $path;
    }

    public function delete(string $entity, string $entityId): void
    {
        $image = Image::where('entity_type', $entity)->where('entity_id', $entityId)->first();
        $currentImageUsed = Image::where('name', $image->name)->count() > 1;
        if (! $currentImageUsed) {
            Storage::disk('public')->delete('uploads/'.$image->name);
        }
        $image->delete();
    }
}
