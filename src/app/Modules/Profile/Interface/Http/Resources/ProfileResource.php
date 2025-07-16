<?php

namespace App\Modules\Profile\Interface\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'full_name'  => $this->full_name,
            'headline'   => $this->headline,
            'bio'        => $this->bio,
            'avatar'     => $this->avatar,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'location'   => $this->location,
            'birthday'   => $this->birthday,
            'social_links' => $this->social_links,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ];
    }
}
