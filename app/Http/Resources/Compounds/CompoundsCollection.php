<?php

namespace App\Http\Resources\Compounds;

use Illuminate\Http\Resources\Json\JsonResource;

class CompoundsCollection extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'composition_id' => $this->composition_id,
            'value' => $this->value
        ];
    }
}