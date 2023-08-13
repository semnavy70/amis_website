<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('advertise_blogs');
        Schema::dropIfExists('advertise_logs');
        Schema::dropIfExists('advertise_pages');
        Schema::dropIfExists('advertises');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
