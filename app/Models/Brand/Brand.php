<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
    protected $fillable = [
        'name',
        'description',
        'country'
    ];
}
