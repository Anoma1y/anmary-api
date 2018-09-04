<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource {
    public function toArray($request) {
        return [
            'phone' => $this->phone,
            'status' => (int)$this->status
        ];
    }
}
