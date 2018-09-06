<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsProportionTable extends Migration
{
    public function up() {
        Schema::create('products_proportion', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('proportion_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('proportion_id')->references('id')->on('sizes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['product_id', 'proportion_id']);
        });
    }

    public function down() {
        Schema::dropIfExists('products_proportion');
    }
}
