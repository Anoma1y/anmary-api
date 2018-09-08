<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->timestamps();
            $table->string('international', 15)->nullable(false);
            $table->string('ru', 10)->nullable(false);
            $table->string('uk', 10)->nullable(false);
            $table->string('us', 10)->nullable(false);
            $table->string('eu', 10)->nullable(false);
            $table->string('it', 10)->nullable(false);
            $table->string('jp', 10)->nullable(false);
            $table->string('chest', 20)->nullable(false);
            $table->string('waist', 20)->nullable(false);
            $table->string('thigh', 20)->nullable(false);
            $table->string('sleeve', 20)->nullable(false);

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
