<?php

namespace App\Services;

use Throwable;
use App\Models\UserRequest;
use App\Mail\RequestResolved;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Api\UserRequestResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserRequestService
{
    public function list(?array $filters): AnonymousResourceCollection
    {
        $status = $filters['status'] ?? null;
        $createdAt = $filters['created_at'] ?? null;

        $requests = UserRequest::with('comment')
            ->when(
                in_array($status, [UserRequest::STATUS_ACTIVE, UserRequest::STATUS_RESOLVED]),
                fn(Builder $query) => $query->where('status', $status),
            )
            ->when(
                $createdAt,
                fn(Builder $query) => is_array($createdAt)
                    ? $query->whereDateBetween('created_at', $createdAt)
                    : $query->whereDate('created_at', $createdAt),
            )
            ->latest()
            ->paginate();

        return UserRequestResource::collection($requests);
    }

    public function create(string $message): void
    {
        auth()->user()->requests()->create([
            'message' => $message,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function resolve(UserRequest $userRequest, string $comment): void
    {
        try {
            DB::beginTransaction();

            $userRequest->comment()->create([
                'user_id' => auth()->id(),
                'text'    => $comment,
            ]);
            $userRequest->update([
                'status' => $userRequest::STATUS_RESOLVED,
            ]);

            Mail::to($userRequest->user)
                ->send(new RequestResolved($userRequest));

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
