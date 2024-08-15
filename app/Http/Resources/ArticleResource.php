<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'thumbnail_url' => $this->thumbnail_url,
            'created_At' => $this->created_at,
            'author_name' => $this->author->name ?? $this->author_name,
            'comment' => $this->comment->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->toDateTimeString(),
                    'author_name' => $comment->author->name
                ];
            })
        ];
    }
}
