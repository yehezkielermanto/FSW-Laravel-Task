<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jadwalkuliah extends Model
{
    use HasFactory;
    public function readJadwal()
    {
        return DB::table('mata_kuliah')
            ->join('dosen', 'dosen.id_dosen', '=', 'mata_kuliah.id_dosen')
            ->get();
    }

    // read jadwal mahasiswa
    public function readJadwalMahasiswa()
    {
        return DB::table('jadwal_mahasiswa')
            ->join(
                'mahasiswa',
                'mahasiswa.id_mahasiswa',
                '=',
                'jadwal_mahasiswa.id_mahasiswa'
            )
            ->join(
                'mata_kuliah',
                'mata_kuliah.id_matkul',
                '=',
                'jadwal_mahasiswa.id_matkul'
            )
            ->get();
    }

    // addJadwal
    public function addJadwal($data)
    {
        try {
            DB::table('jadwal_mahasiswa')->insert([
                'id_matkul' => $data['matkul'],
                'id_mahasiswa' => $data['nama_mahasiswa'],
            ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    public function editJadwal($data, $id)
    {
        try {
            DB::table('jadwal_mahasiswa')
                ->where('id_jadwal', $id)
                ->update([
                    'id_matkul' => $data['matkul'],
                    'id_mahasiswa' => $data['nama_mahasiswa'],
                ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }
    public function deleteJadwal($id)
    {
        try {
            DB::table('jadwal_mahasiswa')
                ->where('id_jadwal', $id)
                ->delete();
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    public function checkJadwal($id)
    {
        // dd($id);
        return DB::table('jadwal_mahasiswa')
            ->join(
                'mata_kuliah',
                'mata_kuliah.id_matkul',
                '=',
                'jadwal_mahasiswa.id_matkul'
            )
            ->join('dosen', 'dosen.id_dosen', '=', 'mata_kuliah.id_dosen')
            ->where('jadwal_mahasiswa.id_mahasiswa', $id)
            ->get();
    }
}
