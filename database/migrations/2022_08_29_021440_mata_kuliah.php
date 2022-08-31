<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MataKuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_dosen');
            $table
                ->foreign('id_dosen')
                ->references('id')
                ->on('dosen');
            $table->string('nama_matkul');
            $table->string('ruang_matkul');
            $table->string('hari_matkul');
            $table->time('jam_matkul');
        });
    }
    public function down()
    {
        Schema::drop('mata_kuliah');
    }
}
