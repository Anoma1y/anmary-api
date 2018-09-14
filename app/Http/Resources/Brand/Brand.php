<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\JsonResource;

class Brand extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string)$this->description,
            'country' => $this->country,
            'products_count' =>
                $this
                    ->select('products.id')
                    ->from('brands')
                    ->join('products', 'brands.id', '=', 'products.brand_id')
                    ->where('brands.id', $this->id)
                    ->get()
                    ->count()
        ];
    }
}