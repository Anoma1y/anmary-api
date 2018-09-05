<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\Image as ImageResource;
use Carbon\Carbon;
use App\Http\Resources\Compounds\CompoundsCollection as CompoundsCollectionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Category\Category as CategoryResource;
use App\Http\Resources\Brand\Brand as BrandResource;
use App\Http\Resources\Season\Season as SeasonResource;

use App\Models\Image\Image;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;

class ProductCollection extends ResourceCollection {
    public function toArray($request) {
        return array_map(function ($product) {
            return [
                'id' => (int)$product->id,
                'name' => (string)$product->name,
                'price' => (int)$product->price,
                'discount' => (int)$product->discount,
                'description' => (string)$product->description,
                'image' => new ImageResource(Image::find((int)$product->image_id)),
                'category' => new CategoryResource(Category::find((int)$product->category_id)),
                'brand' => new BrandResource(Brand::find((int)$product->brand_id)),
                'season' => new SeasonResource(Season::find((int)$product->season_id)),
                'composition' => CompoundsCollectionResource::collection($product->compounds),
                'created_at' => (new Carbon($product->created_at))->getTimestamp(),
                'updated_at' => (new Carbon($product->updated_at))->getTimestamp(),
            ];
        }, $this->collection->toArray());
    }
}
