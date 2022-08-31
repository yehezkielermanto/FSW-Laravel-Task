<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class jadwalMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_mahasiswa')->insert([
            'id_matkul' => 1,
            'id_mahasiswa' => 1,
        ]);
    }
}
