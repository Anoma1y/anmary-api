<?php

namespace App\Http\Resources\Order;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\User\UserNoRoles as UserNoRolesResource;


class OrderCollection extends ResourceCollection {
    public function toArray($request) {
        return array_map(function ($order) {
            return [
                'id' => $order->id,
                'user' => new UserNoRolesResource($order->user),
                'contact_name' => $order->contact_name,
                'contact_detail' => $order->contact_detail,
                'products_count' =>
                    $order
                        ->select('product_id')
                        ->from('orders_products')
                        ->where('order_id', $order->id)
                        ->get()
                        ->count(),
                'created_at' => (new Carbon($order->created_at))->getTimestamp(),
                'updated_at' => (new Carbon($order->updated_at))->getTimestamp(),
            ];
        }, $this->collection->toArray());
    }
}
