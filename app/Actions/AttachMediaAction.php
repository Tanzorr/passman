<?php

namespace App\Actions;

use App\Contracts\MediaServiceInterface;
use App\Contracts\QueryInterface;
use App\Contracts\ReadActionInterface;
use App\Traits\ResolvesEntities;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class AttachMediaAction implements ReadActionInterface
{
    use ResolvesEntities;

    public function __construct(private MediaServiceInterface $mediaService)
    {
    }

    public function handle(QueryInterface $query): JsonResponse
    {
        try {
            $entity = $this->resolveEntity($query->get('mediable_type'), $query->get('mediable_id'));

            $this->mediaService->attachMediaToEntity($entity, $query->get('media_id'));

            return response()->json(['message' => 'Media attached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }
}
