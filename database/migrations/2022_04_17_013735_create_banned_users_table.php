<?php

use App\Enums\BanReasons;
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
        Schema::create('banned_users', function (Blueprint $table) {
            $table->unsignedBigInteger('banned_id');
            $table->unsignedBigInteger('banned_by_id');
            $table->timestamp('banned_at');
            $table->enum('ban_reason', BanReasons::TYPES)->nullable();
            $table->string('ban_comment', 150)->nullable();
            $table->foreign('banned_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('banned_by_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banned_users');
    }
};
