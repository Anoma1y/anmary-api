<?php

namespace App\Http\Resources\Brand;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Brand extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string)$this->description,
            'country' => $this->country,
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
        ];
    }
}