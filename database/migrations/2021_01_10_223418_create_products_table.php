<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name', 60);
            $table->string('slug', 70);
            $table->string('file_path', 50);
            $table->string('image', 100);
            $table->string('reference', 20);
            $table->decimal('price', 11,2);
            $table->integer('in_discount');
            $table->integer('discount');
            $table->text('content');
            $table->integer('status');
            $table->integer('quantity');
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
        Schema::dropIfExists('products');
    }
}
