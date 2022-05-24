<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot', function (Blueprint $table) {
            $table->id();
            $table->char('jenis', 1);
            $table->string('title',30);
            $table->date('mulai');
            $table->date('selesai');
            $table->tinyInteger('jml')->default('0');
            $table->tinyInteger('kuota');
            $table->char('status', 1);
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
        Schema::dropIfExists('slot');
    }
}
