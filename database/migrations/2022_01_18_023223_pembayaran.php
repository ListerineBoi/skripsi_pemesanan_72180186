<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jasa_id')->nullable();
            $table->char('jenis_jasa', 1);
            $table->integer('terbayar')->nullable();
            $table->text('file_invoice')->nullable();
            $table->char('status', 1)->default('0');
            $table->timestamps();
            $table->foreign('jasa_id')->references('id')->on('jasa');
            
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
        Schema::dropIfExists('pembayaran');
    }
}
