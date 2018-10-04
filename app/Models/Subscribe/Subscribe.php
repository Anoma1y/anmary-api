<?php

namespace App\Models\Subscribe;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model {
    protected $fillable = [
        'contact_address',
        'is_active'
    ];

}
