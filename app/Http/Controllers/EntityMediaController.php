<?php

namespace App\Http\Controllers;

use App\Contracts\MediaServiceInterface;
use App\Http\Requests\AttachMediaRequest;
use App\Http\Requests\DetachMediaRequest;
use App\Traits\ResolvesEntities;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class EntityMediaController extends Controller
{
    use ResolvesEntities;

    public function __construct(private MediaServiceInterface $mediaService) {}

    public function attach(AttachMediaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $entityClass = $this->resolveEntity($validated['entity_type'], $validated['entity_id']);
            $entity = $entityClass::findOrFail($validated['entity_id']);
            $this->mediaService->attachMediaToEntity($entity, $validated['media_id']);

            return response()->json(['message' => 'Media attached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Entity not found.'], 404);
        }
    }

    public function detach(DetachMediaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $entityClass = $this->resolveEntity($validated['entity_type'], $validated['entity_id']);
            $entity = $entityClass::findOrFail($request->entity_id);

            $this->mediaService->detachMediaFromEntity($entity, $request->media_id);

            return response()->json(['message' => 'Media detached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Entity not found.'], 404);
        }
    }
}
