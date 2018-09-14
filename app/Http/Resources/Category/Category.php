<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string)$this->description,
            'count' =>
                $this
                    ->select('products.id')
                    ->from('categories')
                    ->join('products', 'categories.id', '=', 'products.category_id')
                    ->where('categories.id', $this->id)
                    ->get()
                    ->count()

        ];
    }
}