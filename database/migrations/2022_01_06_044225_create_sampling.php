<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampling', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('detail_id')->nullable();
            $table->date('tgl_jadi')->nullable();
            $table->char('status', 1);
            $table->timestamps();
            $table->foreign('detail_id')->references('id')->on('detail_pakaian');
            $table->foreign('slot_id')->references('id')->on('slot_s');
            $table->foreign('cus_id')->references('id')->on('users');
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
        Schema::dropIfExists('sampling');
    }
}
