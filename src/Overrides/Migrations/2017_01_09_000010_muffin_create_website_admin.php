<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class MuffinCreateWebsiteAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $user = new User;
        $user->firstname = 'John Robin';
        $user->lastname = 'Perez';
        $user->email = 'johnguild26@gmail.com';
        $user->password = bcrypt('basic101');
        $user->contact = '09359372676';
        $user->newsletter = false;
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
