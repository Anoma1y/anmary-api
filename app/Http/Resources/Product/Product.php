<?php

namespace App\Http\Resources\Product;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string)$this->description,
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
        ];
    }
}