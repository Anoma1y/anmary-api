<?php

namespace App\Models\Subscribe;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model {
    protected $fillable = [
        'email',
        'is_active'
    ];

}
