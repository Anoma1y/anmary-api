<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {
    public function up() {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // Ref to user table
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->string('phone', 50)
                ->nullable(true)
                ->default('');
            $table->tinyInteger('status')
                ->nullable(false)
                ->default(0);
        });
    }

    public function down() {
        Schema::dropIfExists('profiles');
    }
}
