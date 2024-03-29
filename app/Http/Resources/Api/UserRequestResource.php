<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->user->name,
            'email'      => $this->user->email,
            'status'     => $this->status,
            'message'    => $this->message,
            'comment'    => !$this->comment ? null : [
                'name' => $this->comment->user->name,
                'text' => $this->comment->text,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
