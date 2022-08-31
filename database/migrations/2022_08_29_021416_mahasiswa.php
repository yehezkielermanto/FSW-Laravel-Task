<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_prodi');
            $table
                ->foreign('id_prodi')
                ->references('id')
                ->on('prodi');
            $table->string('nama_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('mahasiswa');
    }
}
