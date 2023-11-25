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
            $table->string('organization')->default(null);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('city')->default(null);
            $table->string('zip')->default(null);
            $table->string('address')->default(null);
            $table->unsignedBigInteger('role_id');
            $table->boolean('is_admin')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
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
