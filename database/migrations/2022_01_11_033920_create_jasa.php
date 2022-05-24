<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa', function (Blueprint $table) {
            $table->id();
            $table->char('jenis_jasa', 1);
            $table->unsignedBigInteger('slot_id');
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('detail_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->date('tgl_jadi')->nullable();
            $table->unsignedSmallInteger('jml')->nullable();
            $table->text('permintn')->nullable();
            $table->char('status', 1);
            $table->timestamps();
            $table->foreign('slot_id')->references('id')->on('slot');
            $table->foreign('cus_id')->references('id')->on('users');
            $table->foreign('detail_id')->references('id')->on('detail_pakaian');
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('jasa');
    }
}
