<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'photo_url' => file_exists(public_path($this->photo_url))
                        ? asset($this->photo_url)
                        : 'https://placehold.co/300x300?text=' . urlencode($this->name),
        ];
    }
}
