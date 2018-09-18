<?php

namespace App\Http\Resources\Image;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Image extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'extension' => $this->extension,
            'size' => $this->size,
            'original_uri' => $this->original_uri,
            'is_default' => $this->is_default,
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
            'updated_at' => (new Carbon($this->updated_at))->getTimestamp()
        ];
    }
}