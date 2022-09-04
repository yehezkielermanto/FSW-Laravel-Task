<?php

namespace App\Http\Controllers;

use App\Models\jadwalkuliah;
use Illuminate\Http\Request;
use JadwalMahasiswa;

class mahasiswaController extends Controller
{
    private $jadwalMahasiswa;
    public function __construct()
    {
        $this->jadwalMahasiswa = new jadwalkuliah();
    }
    public function index()
    {
        $id = session()->get('id_mahasiswa');
        // dd($id);
        // dd($this->jadwalMahasiswa->checkJadwal($id));
        return view('mahasiswa.dashboard', [
            'jadwal' => $this->jadwalMahasiswa->checkJadwal($id),
        ]);
    }
}
