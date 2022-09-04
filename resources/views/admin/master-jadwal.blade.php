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
<form action="/admin/tambah_jadwal" method="post" class="card p-3 my-4">
      @csrf
      <div class="row mb-3">
        <div class="col-4">
          <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa</label>
        </div>
        <div class="col-8">
            <select name="nama_mahasiswa" id="nama_mahasiswa" class="form-select">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswa as $m)
                    <option value="{{ $m->id_mahasiswa }}">{{ $m->nama_mahasiswa }}</option>
                @endforeach
              </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="matkul" class="col-form-label">Mata Kuliah</label>
        </div>
        <div class="col-8">
          <select name="matkul" id="matkul" class="form-select">
            <option value="">Pilih Mata Kuliah</option>
            @foreach ($matkul as $mtk)
                <option value="{{ $mtk->id_matkul }}">{{ $mtk->nama_matkul }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Tambah Jadwal Kuliah" class="btn btn-primary float-end">
        </div>
      </div>
    </form>

    {{-- table mahasiswa --}}
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50px;">No.</th>
            <th scope="col" class="text-center">Nama Mahasiswa</th>
            <th scope="col" class="text-center">Mata Kuliah</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $nomor = 0;    
          @endphp
          @if (count($jadwal) <= 0)
              <tr>
                <td colspan="7" class="text-center"> Data Jadwal Masih Kosong</td>
              </tr>
          @else
          @foreach ($jadwal as $item)    
          <tr>
            <td class="text-center">{{ $nomor+=1 }}</td>
            <td class="text-center">{{ $item->nama_mahasiswa }}</td>
            <td class="text-center">{{ $item->nama_matkul }}</td>
            <td class="text-center">
              <!-- Button trigger modal edit -->
              <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_jadwal }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_jadwal }}">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
         
          <!-- Modal edit-->
          <div class="modal fade" id="editModal{{ $item->id_jadwal }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/edit_jadwal/{{ $item->id_jadwal }}" method="post">
                  @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Update Data Mata Kuliah</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <div class="col-4">
                      <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa</label>
                    </div>
                    <div class="col-8">
                        <select name="nama_mahasiswa" id="nama_mahasiswa" class="form-select">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach ($mahasiswa as $m)
                                <option value="{{ $m->id_mahasiswa }}" @if ($m->id_mahasiswa == $item->id_mahasiswa)
                                    {{ 'selected' }}
                                @endif>{{ $m->nama_mahasiswa }}</option>
                            @endforeach
                          </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-4">
                      <label for="matkul" class="col-form-label">Mata Kuliah</label>
                    </div>
                    <div class="col-8">
                      <select name="matkul" id="matkul" class="form-select">
                        <option value="">Pilih Mata Kuliah</option>
                        @foreach ($matkul as $mtk)
                            <option value="{{ $mtk->id_matkul }}" @if ($mtk->id_matkul == $item->id_matkul)
                                    {{ 'selected' }}
                                @endif>{{ $mtk->nama_matkul }}</option>
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
          <div class="modal fade" id="deleteModal{{ $item->id_jadwal }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/delete_jadwal/{{ $item->id_jadwal }}" method="get">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Apakah Yakin menghapus data mata kuliah ini?
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
    </div>
@endsection