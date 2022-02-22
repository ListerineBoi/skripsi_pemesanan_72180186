<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bayar_id')->nullable();
            $table->unsignedSmallInteger('qty');
            $table->text('ket');
            $table->mediumInteger('harga');
            $table->mediumInteger('total');
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
        Schema::dropIfExists('detail_invoice');
    }
}
