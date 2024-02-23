<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'category' => $this->category,
            'image' => $this->image,
            'slug' => $this->slug,
            'detail' => new DetailResource($this->detail),
            'author' => new AuthorResource($this->author),
        ];
    }
}
