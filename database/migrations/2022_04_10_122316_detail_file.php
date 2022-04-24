<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_file', function (Blueprint $table) {
            $table->id();
            $table->text('img', 1);
            $table->unsignedBigInteger('detail_id')->nullable();
            $table->timestamps();
            $table->foreign('detail_id')->references('id')->on('detail_pakaian')->onDelete('cascade');;
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
        Schema::dropIfExists('detail_file');
    }
}
