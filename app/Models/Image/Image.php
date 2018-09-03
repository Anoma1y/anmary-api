<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    const FILES_ROOT_FOLDER = 'docs';

    protected $fillable = [
        'original_name',
        'extension',
        'size',
        'original_uri',
        'preview_uri'
    ];

}
