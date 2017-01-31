<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MuffinCreateDivsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('location');
            $table->integer('rank');
            $table->string('title')->default('');
            $table->string('image', 1000)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divs');
    }
}
