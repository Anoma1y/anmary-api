<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 150)
                ->nullable(true)
                ->default('');

            $table->string('article', 50)
                ->nullable(false);

            $table->text('description')
                ->nullable(true);

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');

            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')
                ->references('id')
                ->on('seasons');

            $table->bigInteger('price')
                ->nullable(false)
                ->default(0);

            $table->integer('discount')
                ->nullable(false)
                ->default(0);

            $table->boolean('is_available')
                ->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
