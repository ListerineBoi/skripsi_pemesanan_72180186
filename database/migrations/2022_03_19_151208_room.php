<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Room extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->char('jenis', 1);
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('samp_id')->nullable();
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('prod_id')->references('id')->on('produksi');
            $table->foreign('samp_id')->references('id')->on('sampling');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('room');
    }
}
