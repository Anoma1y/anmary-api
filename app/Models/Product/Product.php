<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Season\Season;
use App\Models\Image\Image;
use App\Models\Compounds\Compounds;

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

}
