<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mahasiswa extends Model
{
    use HasFactory;
    public function countMahasiswa()
    {
        return DB::table('mahasiswa')->count();
    }

    public function readMahasiswa()
    {
        return DB::table('mahasiswa')
            ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->get();
    }

    public function findMahasiswa($id)
    {
        return DB::table('mahasiswa')
            ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->where('mahasiswa.id_mahasiswa', $id)
            ->get();
    }

    public function addMahasiswa($data)
    {
        try {
            // dd($data);
            DB::table('mahasiswa')->insert([
                'id_prodi' => $data['prodi_mahasiswa'],
                'nama_mahasiswa' => $data['nama_mahasiswa'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    public function editMahasiswa($data, $id)
    {
        try {
            DB::table('mahasiswa')
                ->where('id_mahasiswa', $id)
                ->update([
                    'id_prodi' => $data['prodi_mahasiswa'],
                    'nama_mahasiswa' => $data['nama_mahasiswa'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                ]);
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    // delete mahasiswa
    public function deleteMahasiswa($id)
    {
        try {
            DB::table('mahasiswa')
                ->where('id_mahasiswa', $id)
                ->delete();
            return 'true';
        } catch (\Throwable $th) {
            return 'false';
        }
    }

    public function checkMahasiswa($email, $password)
    {
        try {
            return DB::table('mahasiswa')
                ->where('email', $email)
                ->where('password', $password)
                ->join('prodi', 'prodi.id_prodi', 'mahasiswa.id_prodi')
                ->get();
        } catch (\Throwable $th) {
            return 'false';
        }
    }
}
