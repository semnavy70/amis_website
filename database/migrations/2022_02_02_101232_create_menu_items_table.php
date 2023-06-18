<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
            $table->integer('parent_id')->nullable()->default(0);
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('color')->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->string('route')->nullable();
            $table->string('parameters')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
