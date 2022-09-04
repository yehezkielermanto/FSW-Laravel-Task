<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_mahasiswa', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->unsignedInteger('id_matkul');
            $table->unsignedInteger('id_mahasiswa');
            $table
                ->foreign('id_matkul')
                ->references('id_matkul')
                ->on('mata_kuliah');
            $table
                ->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa');
        });
    }
    public function down()
    {
        Schema::drop('jadwal_mahasiswa');
    }
}
