<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('lastname', 60)->nullable();
            $table->string('id_card', 30)->nullable();
            $table->string('telephone', 30)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('zip_code', 30)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('bill_name', 40)->nullable();
            $table->string('bill_lastname', 60)->nullable();
            $table->string('bill_id_card', 30)->nullable();
            $table->string('bill_telephone', 30)->nullable();
            $table->string('bill_address', 100)->nullable();
            $table->string('bill_zip_code', 30)->nullable();
            $table->string('bill_city', 50)->nullable();
            $table->string('bill_state', 50)->nullable();
            $table->string('bill_country', 50)->nullable();
            $table->string('email', 70)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar', 50)->nullable();
            $table->integer('status')->default('0');
            $table->integer('role')->default('0');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code', 25)->nullable();
            $table->string('password', 70);
            $table->string('password_code', 10)->nullable();
            $table->text('permissions')->nullable();
            $table->timestamp('current_login')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
