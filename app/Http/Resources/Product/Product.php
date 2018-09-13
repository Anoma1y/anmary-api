<?php

namespace App\Http\Resources\Product;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\Category as CategoryResource;
use App\Http\Resources\Brand\Brand as BrandResource;
use App\Http\Resources\Season\Season as SeasonResource;
use App\Http\Resources\Compounds\CompoundsCollection;
use App\Http\Resources\Proportion\ProportionCollection;
use App\Http\Resources\Image\ImageCollection;

use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;

use App\Helpers\Calculate;

class Product extends JsonResource {

    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => (string)$this->name,
            'price' => (int)$this->price,
            'discount' => (int)$this->discount,
            'total_price' => Calculate::calculateDiscount((int)$this->price, (int)$this->discount),
            'description' => (string)$this->description,
            'images' => ImageCollection::collection($this->images),
            'category' => new CategoryResource(Category::find((int)$this->category_id)),
            'brand' => new BrandResource(Brand::find((int)$this->brand_id)),
            'season' => new SeasonResource(Season::find((int)$this->season_id)),
            'compositions' => CompoundsCollection::collection($this->compounds),
            'sizes' => ProportionCollection::collection($this->proportions),
            'is_active' => $this->is_active,
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
            'updated_at' => (new Carbon($this->updated_at))->getTimestamp(),
        ];
    }
}