<?php

namespace App\Contracts;

use App\Models\Media;

interface MediaServiceInterface
{
    public function getAllUserMedia($search = '');

    public function storeMedia($file);

    public function deleteMedia(Media $media);
}
