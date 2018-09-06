<?php

namespace App\Http\Resources\Composition;

use Illuminate\Http\Resources\Json\JsonResource;

class Composition extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string)$this->description
        ];
    }
}