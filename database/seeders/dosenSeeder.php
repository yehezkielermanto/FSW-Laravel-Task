<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class dosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayDosen = [
            'Antonius, S.Kom., M.Kom.',
            'Budi, Spsi.',
            'Santoso, S.H., M.H.',
            'Andi, S.T., M.T.',
            'Tono, S.E., M.M.',
        ];
        $namaDosen = ['antonius', 'budi', 'santoso', 'andi', 'tono'];
        for ($i = 0; $i < count($arrayDosen); $i++) {
            DB::table('dosen')->insert([
                'nama_dosen' => $arrayDosen[$i],
                'email' => $namaDosen[$i] . '@mail.com',
                'password' => $namaDosen[$i] . '123',
            ]);
        }
    }
}
