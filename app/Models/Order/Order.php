<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Order extends Model
{
    protected $fillable = [
        'contact_name',
        'contact_detail'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(
            Product::class, 'orders_products', 'order_id', 'product_id'
        );
    }

    public function attachProducts($product_id, $size_id) {
        DB::table('orders_products')->insert([
            'order_id' => $this->id,
            'product_id' => $product_id,
            'size_id' => $size_id
        ]);
    }
}
