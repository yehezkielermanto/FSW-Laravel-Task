<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class mataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mata_kuliah')->insert([
            'id_dosen' => 1,
            'nama_matkul' => 'Pemrograman Website',
            'ruang_matkul' => '304',
            'hari_matkul' => 'Senin',
            'jam_matkul' => '10:00:00',
        ]);
    }
}
