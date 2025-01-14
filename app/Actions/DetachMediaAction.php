<?php

namespace App\Actions;

use App\Contracts\MediaServiceInterface;
use App\Traits\ResolvesEntities;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class DetachMediaAction
{
    use ResolvesEntities;

    public function __construct(private MediaServiceInterface $mediaService) {}

    public function handle(array $data): bool
    {
        $entity = $this->resolveEntity($data['mediable_type'], $data['mediable_id']);
        $this->mediaService->detachMediaFromEntity($entity, $data['media_id']);

        return true;
    }
}
