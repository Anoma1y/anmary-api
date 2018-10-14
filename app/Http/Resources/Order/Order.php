<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductCollection;
use Carbon\Carbon;
use App\Http\Resources\User\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class Order extends JsonResource {

    public function toArray($request) {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'contact_name' => $this->contact_name,
            'contact_detail' => $this->contact_detail,
            'products' => new ProductCollection($this->products),
            'proportions' => DB::table('orders_products')->where('order_id', $this->id)->get(),
            'created_at' => (new Carbon($this->created_at))->getTimestamp(),
            'updated_at' => (new Carbon($this->updated_at))->getTimestamp(),
        ];
    }
}