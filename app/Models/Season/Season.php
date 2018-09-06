<?php

namespace App\Models\Season;

use Illuminate\Database\Eloquent\Model;

class Season extends Model {
    protected $fillable = [
        'name',
        'description'
    ];
}
