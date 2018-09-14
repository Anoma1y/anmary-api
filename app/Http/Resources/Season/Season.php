<?php

namespace App\Http\Resources\Season;

use Illuminate\Http\Resources\Json\JsonResource;

class Season extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'products_count' =>
                $this
                    ->select('products.id')
                    ->from('seasons')
                    ->join('products', 'seasons.id', '=', 'products.season_id')
                    ->where('seasons.id', $this->id)
                    ->get()
                    ->count()
        ];
    }
}