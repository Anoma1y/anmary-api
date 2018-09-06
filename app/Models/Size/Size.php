<?php

namespace App\Models\Size;

use Illuminate\Database\Eloquent\Model;

class Size extends Model {
    protected $fillable = [
        'international',
        'ru',
        'uk',
        'us',
        'eu',
        'it',
        'jp',
        'chest',
        'waist',
        'thigh',
        'sleeve'
    ];
}
