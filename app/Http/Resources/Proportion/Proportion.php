<?php

namespace App\Http\Resources\Proportion;

use Illuminate\Http\Resources\Json\JsonResource;

class Proportion extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'international' => $this->size->international,
            'ru' => $this->size->ru,
            'uk' => $this->size->uk,
            'us' => $this->size->us,
            'eu' => $this->size->eu,
            'it' => $this->size->it,
            'jp' => $this->size->jp,
            'chest' => $this->size->chest,
            'waist' => $this->size->waist,
            'thigh' => $this->size->thigh,
            'sleeve' => $this->size->sleeve,
        ];
    }
}