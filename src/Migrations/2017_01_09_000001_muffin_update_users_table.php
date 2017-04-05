<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class MuffinUpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('contact');
            $table->boolean('newsletter')->default(false);
        });

        // $user = new User;
        // $user->firstname = 'John Robin';
        // $user->lastname = 'Perez';
        // $user->email = 'admin@muffincms.com';
        // $user->password = bcrypt('basic101');
        // $user->contact = '09359372676';
        // $user->newsletter = false;
        // $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('contact');
            $table->dropColumn('newsletter');
            $table->string('name');
        });
    }
}
