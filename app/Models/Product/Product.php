<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;
use App\Models\Image\Image;
use App\Models\Composition\Composition;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_id',
        'category_id',
        'brand_id',
        'season_id',
        'price',
        'discount'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function season() {
        return $this->belongsTo(Season::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function composition() {
        return $this->belongsToMany(
            Composition::class, 'product_composition', 'product_id', 'composition_id'
        );
    }

}
