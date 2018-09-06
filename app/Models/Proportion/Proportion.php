<?php

namespace App\Models\Proportion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Size\Size;

class Proportion extends Model {
    protected $fillable = [
        'size_id'
    ];

    public function size() {
        return $this->belongsTo(Size::class);
    }

}
