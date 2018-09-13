<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;
use App\Models\Image\Image;
use App\Models\Compounds\Compounds;
use App\Models\Proportion\Proportion;

class Product extends Model
{
    protected $fillable = [
        'name',
        'article',
        'description',
        'category_id',
        'brand_id',
        'season_id',
        'price',
        'discount',
        'is_available'
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

    public function attachCompounds(Compounds $compound) {
        DB::table('products_composition')->insert([
            'product_id' => $this->id, 'compound_id' => $compound->id
        ]);
    }

    public function compounds() {
        return $this->belongsToMany(
            Compounds::class, 'products_composition', 'product_id', 'compound_id'
        );
    }

    public function attachProportions(Proportion $compound) {
        DB::table('products_proportion')->insert([
            'product_id' => $this->id, 'proportion_id' => $compound->id
        ]);
    }

    public function proportions() {
        return $this->belongsToMany(
            Proportion::class, 'products_proportion', 'product_id', 'proportion_id'
        );
    }

    public function attachImages(Image $image) {
        DB::table('products_image')->insert([
            'product_id' => $this->id, 'image_id' => $image->id
        ]);
    }

    public function images() {
        return $this->belongsToMany(
            Image::class, 'products_image', 'product_id', 'image_id'
        );
    }


}
