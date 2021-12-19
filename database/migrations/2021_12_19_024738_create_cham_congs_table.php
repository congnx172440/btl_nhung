<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamCongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cham_congs', function (Blueprint $table) {
            $table->date('ngay_lam_viec');
            $table->bigInteger('id_user')->unsigned();
            $table->dateTime('gio_vao');
            $table->dateTime('gio_ra');
        });
        Schema::table('cham_congs', function(Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cham_congs');
    }
}
