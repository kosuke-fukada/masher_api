<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('account_id', 30)->nullable(false);
            $table->string('display_name', 50)->nullable(false);
            $table->text('avatar')->nullable(false);
            $table->string('access_token')->nullable(false);
            $table->string('refresh_token')->nullable(false);
            $table->string('provider')->nullable(false);
            $table->string('remember_token', 100)->nullable();
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
};
