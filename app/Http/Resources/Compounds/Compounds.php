<?php

namespace App\Http\Resources\Compounds;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Compounds extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'composition_id' => $this->composition_id,
            'value' => $this->value,
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
        ];
    }
}