<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsCompositionTable extends Migration {
    public function up() {
        Schema::create('products_composition', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('compound_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('compound_id')->references('id')->on('compounds')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['product_id', 'compound_id']);
        });
    }

    public function down() {
        Schema::dropIfExists('products_composition');
    }
}
