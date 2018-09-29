<?php

namespace App\Http\Resources\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class Feedback extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'contact_name' => $this->contact_name,
            'contact_address' => $this->contact_address,
            'text' => $this->text
        ];
    }
}