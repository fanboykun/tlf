<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->start_date?->format('M d, Y') . ' - ' . $this->end_date?->format('M d, Y'),
            'time' => $this->start_date?->format('H:i') . ' - ' . $this->end_date?->format('H:i'),
            'desc' => $this->description,
            'tags' => explode(',', $this->tags) ?? $this->tags,
        ];
    }
}
