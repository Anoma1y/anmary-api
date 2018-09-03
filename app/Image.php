<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    protected $fillable = [
        'original_name',
        'extension',
        'size',
        'original_uri',
        'preview_uri'
    ];

}
