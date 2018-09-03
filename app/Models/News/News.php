<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image\Image;

class News extends Model {
    protected $fillable = [
        'name',
        'content',
        'image_id'
    ];

    public function image() {
        return $this->belongsTo(Image::class);
    }

}
