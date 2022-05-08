<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Katalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog', function (Blueprint $table) {
            $table->id();
            $table->tinytext('title');
            $table->text('img_depan')->nullable();
            $table->text('img_belakang')->nullable();
            $table->text('img_dll1')->nullable();
            $table->text('img_dll2')->nullable();
            $table->text('harga');
            $table->text('desc');
            $table->unsignedBigInteger('detail_id_s')->nullable();
            $table->unsignedBigInteger('detail_id_m')->nullable();
            $table->unsignedBigInteger('detail_id_l')->nullable();
            $table->unsignedBigInteger('detail_id_xl')->nullable();
            $table->timestamps();
            $table->foreign('detail_id_s')->references('id')->on('detail_pakaian');
            $table->foreign('detail_id_m')->references('id')->on('detail_pakaian');
            $table->foreign('detail_id_l')->references('id')->on('detail_pakaian');
            $table->foreign('detail_id_xl')->references('id')->on('detail_pakaian');
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
        Schema::dropIfExists('katalog');
    }
}
