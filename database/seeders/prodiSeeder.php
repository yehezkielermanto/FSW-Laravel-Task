<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class prodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayProdi =  ['Informatika', 'Hukum', 'Akuntansi', 'Manajemen', 'Teknik Industri', 'DKV', 'Psikologi', 'Perhotelan', 'Sistem Informasi'];
        for($i=0;$i<count($arrayProdi);$i++){
          DB::table('prodi')->insert([
              'nama_prodi' => $arrayProdi[$i],
          ]);
        }
    }
}
