<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use Carbon\Carbon;

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
            $table->string('key')->default('');
            $table->string('val', 10000)->default('');
            $table->timestamps();
        });

        $dt = Carbon::now();
        $dt = $dt->toW3cString();
        
        $page = new Admin();
        $page->key = 'maintenance';
        $page->val = serialize(['on'=>false, 'opening'=>$dt]);
        $page->save();

        $page = new Admin();
        $page->key = 'users';
        $page->val = serialize(array('registration'=>false));
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
