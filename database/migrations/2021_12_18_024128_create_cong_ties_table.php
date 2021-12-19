<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongTiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cong_ties', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('ten_cong_ty');
            $table->mediumText('dia_chi_cong_ty');
            $table->mediumInteger('id_rfid')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cong_ties');
    }
}
