<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bayar_id')->nullable();
            $table->char('jenis_pembayaran', 1)->nullable();
            $table->text('img_bukti')->nullable();
            $table->text('file_nota')->nullable();
            $table->timestamps();
            $table->foreign('bayar_id')->references('id')->on('pembayaran');
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
        Schema::dropIfExists('nota');
    }
}
