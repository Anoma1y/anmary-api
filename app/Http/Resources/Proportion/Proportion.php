<?php

namespace App\Http\Resources\Proportion;

use Illuminate\Http\Resources\Json\JsonResource;

class Proportion extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'size_id' => $this->size->id,
        ];
    }
}