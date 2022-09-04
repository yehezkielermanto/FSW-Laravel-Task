<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $mahasiswaModel;
    private $adminModel;
    public function __construct()
    {
        $this->mahasiswaModel = new mahasiswa();
        $this->adminModel = new User();
    }
    public function index()
    {
        if (!empty(session()->get('role'))) {
            if (session()->get('role') == 'admin') {
                return redirect()->intended('/admin');
            }
            if (session()->get('role') == 'mahasiswa') {
                return redirect()->intended('/mahasiswa');
            }
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $checkUser = $this->adminModel->checkUser($email, $password);
            $checkMahasiswa = $this->mahasiswaModel->checkMahasiswa(
                $email,
                $password
            );
            // dd($checkMahasiswa);
            if (count($checkUser) > 0) {
                session()->put([
                    'role' => 'admin',
                ]);
                return redirect()->intended('/admin');
            } elseif (!empty($checkMahasiswa)) {
                $id = $checkMahasiswa[0]->id_mahasiswa;
                $nama = $checkMahasiswa[0]->nama_mahasiswa;
                $prodi = $checkMahasiswa[0]->nama_prodi;
                // dd($id);
                session()->put([
                    'role' => 'mahasiswa',
                    'id_mahasiswa' => $id,
                    'nama' => $nama,
                    'prodi' => $prodi,
                ]);
                return redirect()->intended('/mahasiswa');
            } else {
                return back()->withErrors(['email' => 'Email tidak ditemukan']);
            }
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('status', 'Gagal Login');
        }
    }

    // logout
    public function logout()
    {
        session()->flush();
        return redirect()->intended('/');
    }
}
