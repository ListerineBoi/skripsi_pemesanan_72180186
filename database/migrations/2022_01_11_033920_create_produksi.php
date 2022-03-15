<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('detail_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->text('desc');
            $table->date('tgl_jadi')->nullable();
            $table->unsignedSmallInteger('jml');
            $table->char('status', 1);
            $table->timestamps();
            $table->foreign('slot_id')->references('id')->on('slot_p');
            $table->foreign('cus_id')->references('id')->on('users');
            $table->foreign('detail_id')->references('id')->on('detail_pakaian');
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
        Schema::dropIfExists('produksi');
    }
}
