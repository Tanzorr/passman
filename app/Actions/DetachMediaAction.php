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

    public function execute(array $validated): JsonResponse
    {
        try {
            $entity = $this->resolveEntity($validated['entity_type'], $validated['entity_id']);

            $this->mediaService->detachMediaFromEntity($entity, $validated['media_id']);

            return response()->json(['message' => 'Media detached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }
}
