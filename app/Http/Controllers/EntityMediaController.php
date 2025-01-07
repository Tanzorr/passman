<?php

namespace App\Http\Controllers;

use App\Actions\AttachMediaAction;
use App\Actions\DetachMediaAction;
use App\Http\Requests\AttachMediaRequest;
use App\Http\Requests\DetachMediaRequest;
use Illuminate\Http\JsonResponse;

class EntityMediaController extends Controller
{
    public function __construct(
        private AttachMediaAction $attachMediaAction,
        private DetachMediaAction $detachMediaAction
    ) {
    }

    public function attach(AttachMediaRequest $request): JsonResponse
    {
        return $this->attachMediaAction->execute($request->validated());
    }

    public function detach(DetachMediaRequest $request): JsonResponse
    {
        return $this->detachMediaAction->execute($request->validated());
    }
}
