@extends('admin.template')
@section('container')

{{-- alert success --}}
@if (session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
{{-- alert Fail --}}
@if (session('status'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('status')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
{{-- alert role --}}
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first() }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


  <div class="container">
    <form action="/admin/tambah_mahasiswa" method="post" class="card p-3 my-4">
      @csrf
      <div class="row mb-3">
        <div class="col-4">
          <label for="nama_mahasiwa" class="col-form-label">Nama Mahasiswa</label>
        </div>
        <div class="col-8">
          <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" value="{{ old('nama_mahasiswa') }}">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="email_mahasiswa" class="col-form-label">Email Mahasiswa</label>
        </div>
        <div class="col-8">
          <input type="email" name="email" id="email_mahasiswa" class="form-control" value="{{ old('email') }}">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="password_mahasiswa" class="col-form-label">Password Mahasiswa</label>
        </div>
        <div class="col-8">
          <input type="text" name="password" id="password_mahasiswa" class="form-control" value="{{ old('password') }}">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="prodi_mahasiswa" class="col-form-label">Prodi Mahasiswa</label>
        </div>
        <div class="col-8">
          <select name="prodi_mahasiswa" id="prodi_mahasiswa" class="form-select">
            <option value="">Pilih Prodi</option>
            @foreach ($prodi as $item)
                <option value="{{ $item->id_prodi }}">{{ $item->nama_prodi }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Tambah Mahasiswa" class="btn btn-primary float-end">
        </div>
      </div>
    </form>

    {{-- table mahasiswa --}}
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50px;">No.</th>
            <th scope="col" class="text-center">Nama Mahasiswa</th>
            <th scope="col" class="text-center">Email Mahasiswa</th>
            <th scope="col" class="text-center">Prodi Mahasiswa</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $nomor = 0;    
          @endphp
          @if (count($mahasiswa) <= 0)
              <tr>
                <td colspan="5" class="text-center"> Data Mahasiswa Masih Kosong</td>
              </tr>
          @else
          @foreach ($mahasiswa as $item)    
          <tr>
            <td class="text-center">{{ $nomor+=1 }}</td>
            <td class="text-center">{{ $item->nama_mahasiswa }}</td>
            <td class="text-center">{{ $item->email }}</td>
            <td class="text-center">{{ $item->nama_prodi }}</td>
            <td class="text-center">
              <!-- Button trigger modal edit -->
              <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_mahasiswa }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_mahasiswa }}">
                <i class="fa-solid fa-trash"></i>
              </button>
              <a href="/admin/cetak/{{ $item->id_mahasiswa }}" class="btn btn-secondary">
                <i class="fa-solid fa-print"></i>
              </a>
            </td>
          </tr>
          
          <!-- Modal edit-->
          <div class="modal fade" id="editModal{{ $item->id_mahasiswa }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/edit_mahasiswa/{{ $item->id_mahasiswa }}" method="post">
                  @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit Data Mahasiswa</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="nama_mahasiwa" class="col-form-label">Nama Mahasiswa</label>
                      </div>
                      <div class="col-8">
                        <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" value="{{ $item->nama_mahasiswa }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="email_mahasiswa" class="col-form-label">Email Mahasiswa</label>
                      </div>
                      <div class="col-8">
                        <input type="email" name="email" id="email_mahasiswa" class="form-control" value="{{ $item->email }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="password_mahasiswa" class="col-form-label">Password Mahasiswa</label>
                      </div>
                      <div class="col-8">
                        <input type="text" name="password" id="password_mahasiswa" class="form-control" value="{{ $item->password }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="prodi_mahasiswa" class="col-form-label">Prodi Mahasiswa</label>
                      </div>
                      <div class="col-8">
                        <select name="prodi_mahasiswa" id="prodi_mahasiswa" class="form-select">
                          <option value="">Pilih Prodi</option>
                          @foreach ($prodi as $p)
                              <option value="{{ $p->id_prodi }}" @if ($p->id_prodi == $item->id_prodi)
                                  {{ 'selected' }}
                              @endif>{{ $p->nama_prodi }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Update Data" class="btn btn-primary float-end">
                  </div>
                </form>
              </div>
            </div>
          </div>
          {{-- modal delete --}}
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $item->id_mahasiswa }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/delete_mahasiswa/{{ $item->id_mahasiswa }}" method="get">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Apakah Yakin menghapus data mahasiswa ini?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
    </table>
          @endif
        
  </div>   

@endsection