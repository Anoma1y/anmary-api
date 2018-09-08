<?php

namespace App\Http\Resources\Season;

use Illuminate\Http\Resources\Json\JsonResource;

class Season extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}