<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserLikeResource;
use App\Http\Resources\ContentResource;

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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
            ],
            'title' => $this->title,
            'content' => $this->content,
            'peoples_likes' => $this->likes->count(),
            'user_likes' => UserLikeResource::collection($this->likes),
            'peoples_comments' => $this->comments->count(),
            'comments' => ContentResource::collection($this->comments),
            'created_at' => $this->created_at,
        ];
    }
}
