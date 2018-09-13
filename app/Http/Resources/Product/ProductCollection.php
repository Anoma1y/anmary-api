<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\ImageCollection;
use Carbon\Carbon;
use App\Http\Resources\Compounds\CompoundsCollection as CompoundsCollectionResource;
use App\Http\Resources\Proportion\ProportionCollection as ProportionCollectionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Category\Category as CategoryResource;
use App\Http\Resources\Brand\Brand as BrandResource;
use App\Http\Resources\Season\Season as SeasonResource;

use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;

use App\Helpers\Calculate;


class ProductCollection extends ResourceCollection {
    public function toArray($request) {
        return array_map(function ($product) {
            return [
                'id' => (int)$product->id,
                'name' => (string)$product->name,
                'article' => (string)$product->article,
                'price' => (int)$product->price,
                'discount' => (int)$product->discount,
                'total_price' => Calculate::calculateDiscount((int)$product->price, (int)$product->discount),
                'description' => (string)$product->description,
                'images' => ImageCollection::collection($product->images),
                'category' => new CategoryResource(Category::find((int)$product->category_id)),
                'brand' => new BrandResource(Brand::find((int)$product->brand_id)),
                'season' => new SeasonResource(Season::find((int)$product->season_id)),
                'composition' => CompoundsCollectionResource::collection($product->compounds),
                'sizes' => ProportionCollectionResource::collection($product->proportions),
                'is_available' => $product->is_available,
                'created_at' => (new Carbon($product->created_at))->getTimestamp(),
                'updated_at' => (new Carbon($product->updated_at))->getTimestamp(),
            ];
        }, $this->collection->toArray());
    }
}
