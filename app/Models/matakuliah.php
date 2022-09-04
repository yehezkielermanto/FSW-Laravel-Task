<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class matakuliah extends Model
{
    use HasFactory;
    public function countMataKuliah()
    {
        return DB::table('mata_kuliah')->count();
    }

    // readMatkul
    public function readMatkul()
    {
        return DB::table('mata_kuliah')
            ->join('dosen', 'dosen.id_dosen', '=', 'mata_kuliah.id_dosen')
            ->get();
    }

    // add matkul
    public function addMatkul($data)
    {
        // dd($data);
        try {
            DB::table('mata_kuliah')->insert([
                'id_dosen' => $data['dosen_pengampu'],
                'nama_matkul' => $data['nama_matkul'],
                'ruang_matkul' => $data['ruang_matkul'],
                'hari_matkul' => $data['hari_matkul'],
                'jam_matkul' => $data['jam_matkul'],
            ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    public function editMatkul($data, $id)
    {
        try {
            DB::table('mata_kuliah')
                ->where('id_matkul', $id)
                ->update([
                    'id_dosen' => $data['dosen_pengampu'],
                    'nama_matkul' => $data['nama_matkul'],
                    'ruang_matkul' => $data['ruang_matkul'],
                    'hari_matkul' => $data['hari_matkul'],
                    'jam_matkul' => $data['jam_matkul'],
                ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    // delete matkul
    public function deleteMatkul($id)
    {
        try {
            DB::table('mata_kuliah')
                ->where('id_matkul', $id)
                ->delete();
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }
}
