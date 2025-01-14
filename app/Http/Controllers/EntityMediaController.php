<?php

namespace App\Http\Controllers;

use App\Actions\AttachMediaAction;
use App\Actions\DetachMediaAction;
use App\Http\Requests\AttachMediaRequest;
use App\Http\Requests\DetachMediaRequest;
use App\Queries\GetUsersQuery;
use Illuminate\Http\JsonResponse;

class EntityMediaController extends Controller
{
    public function __construct(
        private AttachMediaAction $attachMediaAction,
        private DetachMediaAction $detachMediaAction
    ) {}

    public function attach(AttachMediaRequest $request): JsonResponse
    {
        return $this->attachMediaAction->handle(new GetUsersQuery($request->validated()));
    }

    public function detach(DetachMediaRequest $request): JsonResponse
    {
        return $this->detachMediaAction->execute($request->validated());
    }
}
