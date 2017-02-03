<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;

class MuffinCreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('value', 10000)->default('');
            $table->timestamps();
        });


        $page = new Admin();
        $page->name = 'maintenance';
        $page->value = serialize(array('on'=>false, 'openning'=>'some date here'));
        $page->save();

        $page = new Admin();
        $page->name = 'users';
        $page->value = serialize(array('registration'=>false));
        $page->save();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
