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
    <form action="/admin/tambah_matkul" method="post" class="card p-3 my-4">
      @csrf
      <div class="row mb-3">
        <div class="col-4">
          <label for="nama_matkul" class="col-form-label">Nama Mata Kuliah</label>
        </div>
        <div class="col-8">
          <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" value="{{ old('nama_matkul') }}">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="dosen_pengampu" class="col-form-label">Dosen Pengampu</label>
        </div>
        <div class="col-8">
          <select name="dosen_pengampu" id="dosen_pengampu" class="form-select">
            <option value="">Pilih Dosen Pengampu</option>
            @foreach ($dosen as $item)
                <option value="{{ $item->id_dosen }}">{{ $item->nama_dosen }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="ruang_matkul" class="col-form-label">Ruangan</label>
        </div>
        <div class="col-8">
          <input type="text" name="ruang_matkul" id="ruang_matkul" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="hari_matkul" class="col-form-label">Hari</label>
        </div>
        <div class="col-8">
          @php
              $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']
          @endphp
          <select name="hari_matkul" id="hari_matkul" class="form-select">
            <option value="">Pilih Hari</option>
            @php
                for($i=0;$i<count($hari);$i++){
                  echo "<option value='$hari[$i]'>$hari[$i]</option>";
                }
            @endphp
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          <label for="jam_matkul">Waktu</label>
        </div>
        <div class="col-8">
          <input type="time" name="jam_matkul" id="jam_matkul" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Tambah Mata Kuliah" class="btn btn-primary float-end">
        </div>
      </div>
    </form>

    {{-- table mahasiswa --}}
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50px;">No.</th>
            <th scope="col" class="text-center">Nama Mata Kuliah</th>
            <th scope="col" class="text-center">Dosen Pengampu</th>
            <th scope="col" class="text-center">Ruangan</th>
            <th scope="col" class="text-center">Hari</th>
            <th scope="col" class="text-center">Waktu</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $nomor = 0;    
          @endphp
          @if (count($matakuliah) <= 0)
              <tr>
                <td colspan="7" class="text-center"> Data Mata Kuliah Masih Kosong</td>
              </tr>
          @else
          @foreach ($matakuliah as $item)    
          <tr>
            <td class="text-center">{{ $nomor+=1 }}</td>
            <td class="text-center">{{ $item->nama_matkul }}</td>
            <td class="text-center">{{ $item->nama_dosen }}</td>
            <td class="text-center">{{ $item->ruang_matkul }}</td>
            <td class="text-center">{{ $item->hari_matkul }}</td>
            <td class="text-center">{{ $item->jam_matkul }}</td>
            <td class="text-center">
              <!-- Button trigger modal edit -->
              <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_matkul }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_matkul }}">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
          <!-- Modal edit-->
          <div class="modal fade" id="editModal{{ $item->id_matkul }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/edit_matkul/{{ $item->id_matkul }}" method="post">
                  @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Update Data Mata Kuliah</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="nama_matkul" class="col-form-label">Nama Mata Kuliah</label>
                      </div>
                      <div class="col-8">
                        <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" value="{{ $item->nama_matkul }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="dosen_pengampu" class="col-form-label">Dosen Pengampu</label>
                      </div>
                      <div class="col-8">
                        <select name="dosen_pengampu" id="dosen_pengampu" class="form-select">
                          <option value="">Pilih Dosen Pengampu</option>
                          @foreach ($dosen as $d)
                              <option value="{{ $d->id_dosen }}" @if ($d->id_dosen == $item->id_dosen)
                                  {{ 'selected' }}
                              @endif >{{ $d->nama_dosen }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="ruang_matkul" class="col-form-label">Ruangan</label>
                      </div>
                      <div class="col-8">
                        <input type="text" name="ruang_matkul" id="ruang_matkul" class="form-control" value="{{ $item->ruang_matkul }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="hari_matkul" class="col-form-label">Hari</label>
                      </div>
                      <div class="col-8">
                        @php
                            $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']
                        @endphp
                        <select name="hari_matkul" id="hari_matkul" class="form-select">
                          <option value="">Pilih Hari</option>
                          @php
                              for($i=0;$i<count($hari);$i++){
                                if($hari[$i] == $item->hari_matkul){ 
                                  echo" <option selected value='$hari[$i]'>$hari[$i]</option>";
                                }
                                echo "<option value='$hari[$i]'>$hari[$i]</option>";
                              }
                          @endphp
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="jam_matkul">Waktu</label>
                      </div>
                      <div class="col-8">
                        <input type="time" name="jam_matkul" id="jam_matkul" class="form-control" value="{{ $item->jam_matkul }}">
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
          <div class="modal fade" id="deleteModal{{ $item->id_matkul }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/admin/delete_matkul/{{ $item->id_matkul }}" method="get">
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
          @endif
        </tbody>
      </table>
  </div>   
@endsection