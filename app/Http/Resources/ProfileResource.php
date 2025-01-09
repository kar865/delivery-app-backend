<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'location' => $this->location,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'profile_photo' => asset($this->profile_photo),
        ];
    }
}
