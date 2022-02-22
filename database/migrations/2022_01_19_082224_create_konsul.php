<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->unsignedBigInteger('samp_id')->nullable();
            $table->tinytext('title');
            $table->date('tgl');
            $table->time('mulai', $precision = 0);
            $table->char('status', 1);
            $table->foreign('prod_id')->references('id')->on('produksi');
            $table->foreign('samp_id')->references('id')->on('sampling');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('konsul');
    }
}
