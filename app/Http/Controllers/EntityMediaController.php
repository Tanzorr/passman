<?php

namespace App\Http\Controllers;

use App\Contracts\MediaServiceInterface;
use App\Http\Requests\AttachMediaRequest;
use App\Models\Password;
use App\Models\User;
use App\Models\Vault;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntityMediaController extends Controller
{
    public function __construct(private MediaServiceInterface $mediaService) {}

    public function attach(AttachMediaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $entityClass = $this->resolveEntityClass($validated['entity_type']);
            $entity = $entityClass::findOrFail($validated['entity_id']);
            $this->mediaService->attachMediaToEntity($entity, $validated['media_id']);

            return response()->json(['message' => 'Media attached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Entity not found.'], 404);
        }
    }

    public function detach(Request $request): JsonResponse
    {
        $request->validate([
            'media_id' => 'required|exists:media,id',
        ]);

        try {
            $entityClass = $this->resolveEntityClass($request->entity_type);
            $entity = $entityClass::findOrFail($request->entity_id);

            $this->mediaService->detachMediaFromEntity($entity, $request->media_id);

            return response()->json(['message' => 'Media detached successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Entity not found.'], 404);
        }
    }

    private function resolveEntityClass($entityType): string
    {
        $map = [
            'vault' => Vault::class,
            'password' => Password::class,
            'user' => User::class,
        ];

        if (! array_key_exists($entityType, $map)) {
            throw new ModelNotFoundException('Entity type not recognized.');
        }

        return $map[$entityType];
    }
}
