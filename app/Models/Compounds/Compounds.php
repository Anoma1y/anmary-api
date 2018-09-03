<?php

namespace App\Models\Compounds;

use Illuminate\Database\Eloquent\Model;
use App\Models\Composition\Composition;

class Compounds extends Model {
    protected $fillable = [
        'composition_id',
        'value'
    ];

    public function composition() {
        return $this->belongsTo(Composition::class);
    }

}
