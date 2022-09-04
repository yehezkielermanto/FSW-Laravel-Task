<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\prodi;

use App\Models\mahasiswa;
use App\Models\matakuliah;
use App\Models\jadwalkuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private $mahasiswaModel;
    private $dosenModel;
    private $matakuliahModel;
    private $jadwalKuliahModel;
    private $prodiModel;
    public function __construct()
    {
        $this->mahasiswaModel = new mahasiswa();
        $this->dosenModel = new dosen();
        $this->matakuliahModel = new matakuliah();
        $this->jadwalKuliahModel = new jadwalkuliah();
        $this->prodiModel = new prodi();
    }

    public function index()
    {
        // dd($this->mahasiswaModel->countMahasiswa());
        return view('admin.dashboard', [
            'totalMahasiswa' => $this->mahasiswaModel->countMahasiswa(),
            'totalDosen' => $this->dosenModel->countDosen(),
            'totalMataKuliah' => $this->matakuliahModel->countMataKuliah(),
            'jadwal' => $this->jadwalKuliahModel->readJadwal(),
        ]);
    }

    public function mahasiswa()
    {
        return view('admin.master-mahasiswa', [
            'mahasiswa' => $this->mahasiswaModel->readMahasiswa(),
            'prodi' => $this->prodiModel->readProdi(),
        ]);
    }

    public function tambah_mahasiswa(Request $request)
    {
        // dd($request->input());
        $validation = Validator::make(
            $request->input(),
            [
                'nama_mahasiswa' => 'required|unique:mahasiswa,nama_mahasiswa',
                'email' => 'required|email|unique:mahasiswa,email',
                'password' => 'required',
                'prodi_mahasiswa' => 'required',
            ],
            [
                'nama_mahasiswa.required' => 'Nama Mahasiswa harus diisi',
                'nama_mahasiswa.unique' => 'Nama Mahasiswa sudah ada',
                'email.required' => 'Email mahasiswa harus diisi',
                'email.email' => 'Email mahasiswa harus berformat email',
                'email.unique' => 'Email telah digunakan',
                'password.required' => 'password harus diisi',
                'prodi_mahasiswa.required' => 'Prodi harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->mahasiswaModel->addMahasiswa($request->input());
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with(
                    'message',
                    'Berhasil Tambah Mahasiswa Baru'
                );
            } elseif ($status == 'false') {
                return back()->with(
                    'status',
                    'Gagal menambahkan data mahasiswa baru'
                );
            }
        }
    }

    public function edit_mahasiswa(Request $request, $id)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'nama_mahasiswa' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'prodi_mahasiswa' => 'required',
            ],
            [
                'nama_mahasiswa.required' => 'Nama Mahasiswa harus diisi',
                'email.required' => 'Email mahasiswa harus diisi',
                'email.email' => 'Email mahasiswa harus berformat email',
                'password.required' => 'password harus diisi',
                'prodi_mahasiswa.required' => 'Prodi harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->mahasiswaModel->editMahasiswa(
                $request->input(),
                $id
            );
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with(
                    'message',
                    'Berhasil update data Mahasiswa'
                );
            } elseif ($status == 'false') {
                return back()->with('status', 'Gagal update data mahasiswa');
            }
        }
    }

    // delete mahasiswa
    public function delete_mahasiswa($id)
    {
        $status = $this->mahasiswaModel->deleteMahasiswa($id);
        if ($status == 'true') {
            // dd('hello');
            return back()->with('message', 'Berhasil hapus data Mahasiswa');
        } elseif ($status == 'false') {
            return back()->with('status', 'Gagal hapus data mahasiswa');
        }
    }

    // matakuliah
    public function matakuliah()
    {
        return view('admin.master-matkul', [
            'matakuliah' => $this->matakuliahModel->readMatkul(),
            'dosen' => $this->dosenModel->readDosen(),
        ]);
    }

    public function add_matkul(Request $request)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'nama_matkul' => 'required|unique:mata_kuliah,nama_matkul',
                'dosen_pengampu' => 'required',
                'ruang_matkul' => 'required|unique:mata_kuliah,ruang_matkul',
                'hari_matkul' => 'required',
                'jam_matkul' => 'required',
            ],
            [
                'nama_matkul.required' => 'Nama Mata Kuliah harus diisi',
                'nama_matkul.unique' => 'Nama Mata Kuliah sudah ada',
                'dosen_pengampu.required' => 'Dosen Pengampu Harus diisi',
                'ruang_matkul.required' => 'Ruangan harus diisi',
                'ruang_matkul.unique' => 'Ruangan sudah digunakan',
                'hari_matkul.required' => 'Hari harus dipilih',
                'jam_matkul.required' => 'Jam harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->matakuliahModel->addMatkul($request->input());
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with(
                    'message',
                    'Berhasil Tambah Mata Kuliah Baru'
                );
            } elseif ($status == 'false') {
                return back()->with(
                    'status',
                    'Gagal menambahkan data mata kuliah baru'
                );
            }
        }
    }

    // edit matkul
    public function edit_matkul(Request $request, $id)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'nama_matkul' => 'required',
                'dosen_pengampu' => 'required',
                'ruang_matkul' => 'required',
                'hari_matkul' => 'required',
                'jam_matkul' => 'required',
            ],
            [
                'nama_matkul.required' => 'Nama Mata Kuliah harus diisi',
                'dosen_pengampu.required' => 'Dosen Pengampu Harus diisi',
                'ruang_matkul.required' => 'Ruangan harus diisi',
                'hari_matkul.required' => 'Hari harus dipilih',
                'jam_matkul.required' => 'Jam harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->matakuliahModel->editMatkul(
                $request->input(),
                $id
            );
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with(
                    'message',
                    'Berhasil update data Mata Kuliah'
                );
            } elseif ($status == 'false') {
                return back()->with('status', 'Gagal update data matakuliah');
            }
        }
    }

    public function delete_matkul($id)
    {
        $status = $this->matakuliahModel->deleteMatkul($id);
        if ($status == 'true') {
            // dd('hello');
            return back()->with('message', 'Berhasil hapus data Mahasiswa');
        } elseif ($status == 'false') {
            return back()->with('status', 'Gagal hapus data mahasiswa');
        }
    }

    // jadwal kuliah
    public function jadwal()
    {
        return view('admin.master-jadwal', [
            'jadwal' => $this->jadwalKuliahModel->readJadwalMahasiswa(),
            'mahasiswa' => $this->mahasiswaModel->readMahasiswa(),
            'matkul' => $this->matakuliahModel->readMatkul(),
        ]);
    }

    // add jadwal
    public function add_jadwal(Request $request)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'nama_mahasiswa' => 'required',
                'matkul' => 'required',
            ],
            [
                'nama_mahasiswa.required' => 'Nama Mahasiswa harus dipilih',
                'matkul.required' => 'Mata Kuliah harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->jadwalKuliahModel->addJadwal($request->input());
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with('message', 'Berhasil tambah Jadwal');
            } elseif ($status == 'false') {
                return back()->with('status', 'Gagal tambah jadwal');
            }
        }
    }
    // edit jadwal
    public function edit_jadwal(Request $request, $id)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'nama_mahasiswa' => 'required',
                'matkul' => 'required',
            ],
            [
                'nama_mahasiswa.required' => 'Nama Mahasiswa harus dipilih',
                'matkul.required' => 'Mata Kuliah harus dipilih',
            ]
        );
        if ($validation->fails()) {
            // dd($validation->errors());
            return back()
                ->withInput()
                ->withErrors($validation->errors());
        } else {
            // dd($request->input());
            $status = $this->jadwalKuliahModel->editJadwal(
                $request->input(),
                $id
            );
            // dd($status);
            if ($status == 'true') {
                // dd('hello');
                return back()->with('message', 'Berhasil update Jadwal');
            } elseif ($status == 'false') {
                return back()->with('status', 'Gagal update jadwal');
            }
        }
    }

    // delete jadwal
    public function delete_jadwal($id)
    {
        $status = $this->jadwalKuliahModel->deleteJadwal($id);
        if ($status == 'true') {
            // dd('hello');
            return back()->with('message', 'Berhasil hapus data Mahasiswa');
        } elseif ($status == 'false') {
            return back()->with('status', 'Gagal hapus data mahasiswa');
        }
    }

    public function cetak($id)
    {
        return view('admin.print', [
            'jadwal' => $this->jadwalKuliahModel->checkJadwal($id),
            'mahasiswa' => $this->mahasiswaModel->findMahasiswa($id),
        ]);
    }

    public function printJadwal()
    {
        $data = PDF::loadview('admin.print', [
            'data' => 'ini adalah contoh laporan PDF',
        ]);
        return $data->download('laporan.pdf');
    }
}
