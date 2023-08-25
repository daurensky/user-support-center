<?php

namespace App\Http\Controllers\Api;

use App\Models\UserRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\UserRequestService;
use App\Http\Requests\Api\UserRequestStoreRequest;
use App\Http\Requests\Api\UserRequestUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserRequestController extends Controller
{
    public function __construct(
        private readonly UserRequestService $userRequestService,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return $this->userRequestService->list(
            filters: request('filter'),
        );
    }

    public function store(UserRequestStoreRequest $request): JsonResponse
    {
        $this->userRequestService->create(
            message: $request->input('message'),
        );

        return response()->json([
            'message' => __('Заявка успешно создана'),
        ]);
    }

    public function update(UserRequestUpdateRequest $request, UserRequest $userRequest): JsonResponse
    {
        if ($userRequest->status === $userRequest::STATUS_RESOLVED) {
            return response()->json([
                'message' => __('Заявка уже обработана'),
            ], 422);
        }

        $this->userRequestService->resolve(
            userRequest: $userRequest,
            comment: $request->input('comment'),
        );

        return response()->json([
            'message' => __('Заявка успешно обновлена'),
        ]);
    }

    public function destroy(UserRequest $userRequest): JsonResponse
    {
        if ($userRequest->status === $userRequest::STATUS_RESOLVED) {
            return response()->json([
                'message' => __('Заявка уже обработана'),
            ], 400);
        }

        $userRequest->delete();

        return response()->json([
            'message' => __('Заявка удалена'),
        ]);
    }
}
