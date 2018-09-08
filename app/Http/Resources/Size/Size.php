<?php

namespace App\Http\Resources\Size;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Size extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'international' => (string)$this->international,
            'ru' => (string)$this->ru,
            'uk' => (string)$this->uk,
            'us' => (string)$this->us,
            'eu' => (string)$this->eu,
            'it' => (string)$this->it,
            'jp' => (string)$this->jp,
            'chest' => (string)$this->chest,
            'waist' => (string)$this->waist,
            'thigh' => (string)$this->thigh,
            'sleeve' => (string)$this->sleeve,
        ];
    }
}