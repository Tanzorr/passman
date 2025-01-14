<?php

namespace App\Actions;

use App\Contracts\MediaServiceInterface;
use App\Contracts\QueryInterface;
use App\Contracts\ReadActionInterface;
use App\Traits\ResolvesEntities;

class AttachMediaAction implements ReadActionInterface
{
    use ResolvesEntities;

    public function __construct(private MediaServiceInterface $mediaService)
    {
    }

    public function handle(QueryInterface $query): mixed
    {
        $entity = $this->resolveEntity($query->get('mediable_type'), $query->get('mediable_id'));
        $this->mediaService->attachMediaToEntity($entity, $query->get('media_id'));

        return $entity;
    }
}
