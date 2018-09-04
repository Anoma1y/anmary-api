<?php

namespace App\Http\Resources\Session;

use Illuminate\Http\Resources\Json\JsonResource;

class Session extends JsonResource {
    public function toArray($request) {
        return [
            'token' => $this->token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in
        ];
    }
}
