<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailPakaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pakaian', function (Blueprint $table) {
            $table->id();
            $table->char('model', 2);
            $table->text('img');
            $table->char('ling_b', 5)->nullable();
            $table->char('ling_pgang', 5)->nullable();
            $table->char('ling_pingl', 5)->nullable();
            $table->char('ling_lh', 5)->nullable();
            $table->char('leb_bahu', 5)->nullable();
            $table->char('pj_lengan', 5)->nullable();
            $table->char('ling_kr_leng', 5)->nullable();
            $table->char('ling_lengan', 5)->nullable();
            $table->char('ling_pergel', 5)->nullable();
            $table->char('leb_muka', 5)->nullable();
            $table->char('leb_pungg', 5)->nullable();
            $table->char('panj_pungg', 5)->nullable();
            $table->char('panj_baju', 5)->nullable();
            $table->char('tinggi_pingl', 5)->nullable();
            $table->char('ling_pinggang', 5)->nullable();
            $table->char('ling_pesak', 5)->nullable();
            $table->char('ling_paha', 5)->nullable();
            $table->char('ling_lutut', 5)->nullable();
            $table->char('ling_kaki', 5)->nullable();
            $table->char('panj_cln_rok', 5)->nullable();
            $table->char('tingg_dudk', 5)->nullable();
            $table->text('desc');
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
        Schema::dropIfExists('detail_pakaian');
    }
}
