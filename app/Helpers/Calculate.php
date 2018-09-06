<?php

namespace App\Helpers;


class Calculate {
    public static function calculateDiscount($price, $discount = 0) {

        if ($discount <= 0) {
            return $price;
        }

        $total_price = round($price - ($price * ($discount / 100)));

        return $total_price;

    }
}