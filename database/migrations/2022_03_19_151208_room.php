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
            $table->unsignedBigInteger('samp_id')->nullable();
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->timestamps();
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
