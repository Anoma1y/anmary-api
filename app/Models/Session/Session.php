<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;

class Session extends Model {
    protected $fillable = [
        'token',
        'token_type',
        'expires_in'
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->token_type = 'bearer';
    }
}
