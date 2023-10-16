<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserLikeResource;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => [
                'id' => $this->user->id,
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
            ],
            'title' => $this->title,
            'content' => $this->content,
            'likes' => $this->likes->count(),
            'user_likes' => UserLikeResource::collection($this->likes),
            'created_at' => $this->created_at,
        ];
    }
}
