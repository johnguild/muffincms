<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Page\Page;

class MuffinCreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->boolean('public')->default(false);
            $table->string('template')->default('index');
            $table->timestamps();
        });

        $page = new Page();
        $page->name = 'home';
        $page->public = true;
        $page->template = 'home';
        $page->save();

        $page = new Page();
        $page->name = 'maintenance';
        $page->public = true;
        $page->template = 'maintenance';
        $page->save();

        $page = new Page();
        $page->name = 'about-us';
        $page->public = true;
        $page->template = 'generic';
        $page->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
