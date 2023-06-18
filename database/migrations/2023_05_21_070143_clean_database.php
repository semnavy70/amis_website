<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sync_loggers');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('channels');
        Schema::dropIfExists('episodes');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('videos_bk');
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
