<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable()->default("draft");
            $table->string('blog')->nullable()->default("normal");
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('by')->nullable()->default(0);
            $table->string('source')->nullable();
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->string('image_tablet')->nullable();
            $table->string('image_mobile')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->string('image_top_news')->nullable();
            $table->integer('view_count')->nullable()->default(0);
            $table->integer('shared_count')->nullable()->default(0);
            $table->integer('like_count')->nullable()->default(0);
            $table->integer('comment_count')->nullable()->default(0);
            $table->text('seo_title')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
