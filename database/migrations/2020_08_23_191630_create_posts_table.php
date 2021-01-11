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
            $table->integer('status');
            $table->string('title', 80);
            $table->string('slug', 80);
            $table->text('content');
            $table->string('short', 165);
            $table->string('file_path', 50);
            $table->string('image', 50);
            $table->integer('user_id');
            $table->integer('category');
            $table->string('meta_keywords', 80);
            $table->string('meta_description', 165);
            $table->string('robots', 20);
            $table->string('links', 20);
            $table->softDeletes();
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
