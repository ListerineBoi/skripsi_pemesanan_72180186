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
            $table->unsignedBigInteger('jasa_id')->nullable();
            $table->tinytext('title');
            $table->date('tgl');
            $table->time('mulai', $precision = 0);
            $table->char('jenis', 1);
            $table->text('link', 1)->nullable();
            $table->char('status', 1);
            $table->foreign('jasa_id')->references('id')->on('jasa');
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
