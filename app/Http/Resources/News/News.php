<?php

namespace App\Http\Resources\News;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Image\Image as ImageResource;
use App\Models\Image\Image;

class News extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => (string)$this->content,
            'image' => new ImageResource(Image::find((int)$this->image_id)),
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
            'updated_at' => (new Carbon($this->updated_at))->getTimestamp(),
        ];
    }
}