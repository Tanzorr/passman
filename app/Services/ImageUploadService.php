<?php

namespace App\Services;

use App\Models\FileHash;
use Illuminate\Http\UploadedFile;

class ImageUploadService
{
    public function upload(UploadedFile $file): string
    {
        $fileHash = $this->generateFileHash($file);

        $existingFile = $this->findFileByHash($fileHash);
        if ($existingFile) {
            return $existingFile;
        }

        $fileName = $this->generateUniqueFileName($file);
        $path = $file->storeAs('uploads', $fileName, 'public');

        $this->storeFileHashInDatabase($fileHash, $path);

        $appUrl = config('app.url');

        return $appUrl.'/storage/'.$path;
    }

    private function generateFileHash(UploadedFile $file): string
    {
        return hash_file('sha256', $file->getRealPath());
    }

    private function findFileByHash(string $fileHash): ?string
    {
        $fileRecord = FileHash::where('hash', $fileHash)->first();

        return $fileRecord ? $fileRecord->path : null;
    }

    private function generateUniqueFileName(UploadedFile $file): string
    {
        return uniqid().'.'.$file->getClientOriginalExtension();
    }

    private function storeFileHashInDatabase(string $fileHash, string $path): void
    {
        FileHash::create([
            'hash' => $fileHash,
            'path' => $path,
        ]);
    }
}
