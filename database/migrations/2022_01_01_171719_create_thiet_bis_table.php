<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThietBisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thiet_bis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_thiet_bi',20);
            $table->integer('id_cong_ty')->unsigned();
            $table->string('trangthai',2);
            $table->string('id_rfid',32);
            $table->unsignedTinyInteger('count');
        });
        Schema::table('thiet_bis', function (Blueprint $table){
            $table->foreign('id_cong_ty')->references('id')->on('cong_ties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thiet_bis');
    }
}
