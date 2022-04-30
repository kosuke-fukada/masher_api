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
        Schema::create('nuxt_sessions', function (Blueprint $table) {
            $table->string('session_id', 128)->collation('utf8mb4_bin')->nullable(false)->primary();
            $table->unsignedInteger('expires')->nullable(false);
            $table->mediumText('data')->collation('utf8mb4_bin')->nullable(false);
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
        Schema::dropIfExists('nuxt_sessions');
    }
};
