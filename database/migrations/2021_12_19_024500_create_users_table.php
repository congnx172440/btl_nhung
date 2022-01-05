<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ten_hien_thi',16);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('id_cong_ty')->unsigned();
            $table->integer('id_vi_tri')->unsigned();
            $table->string('id_rfid',32);
            $table->rememberToken();
        });
        Schema::table('users', function (Blueprint $table){
            $table->foreign('id_cong_ty')->references('id')->on('cong_ties');
            $table->foreign('id_vi_tri')->references('id')->on('vi_tris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
