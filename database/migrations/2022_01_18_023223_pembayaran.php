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
            $table->unsignedBigInteger('samp_id')->nullable();
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->char('jenis_jasa', 1);
            $table->char('jenis_pembayaran', 1)->nullable();
            $table->text('img_bukti')->nullable();
            $table->text('file_invoice')->nullable();
            $table->char('status', 1)->default('0');
            $table->timestamps();
            $table->foreign('samp_id')->references('id')->on('sampling');
            $table->foreign('prod_id')->references('id')->on('produksi');
            
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
