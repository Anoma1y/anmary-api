<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Resources\Json\JsonResource;

class Subscribe extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'contact_address' => $this->contact_address,
            'is_active' => $this->is_active
        ];
    }
}