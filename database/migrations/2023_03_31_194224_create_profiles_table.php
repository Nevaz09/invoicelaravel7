<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('photo', 30)->nullable();
            $table->string('nama_depan', 30)->nullable();
            $table->string('nama_belakang', 30)->nullable();
            $table->date('bod')->nullable();
            $table->string('telp', 30)->nullable();
            $table->string('alamat', 500)->nullable();
            $table->string('kota', 20)->nullable();
            $table->string('provinsi', 30)->nullable();
            $table->string('kode_pos', 6)->nullable();
            $table->string('negara', 30)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
