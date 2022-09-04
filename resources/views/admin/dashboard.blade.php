@extends('admin.template')

@section('container')
    <div class="container">
      <h5 class="my-4">Jumlah Mahasiswa: {{ $totalMahasiswa }} </h5>
      <h5 class="my-4">Jumlah Dosen: {{ $totalDosen }} </h5>
      <h5 class="my-4">Jumlah MataKuliah: {{ $totalMataKuliah }} </h5>
      
      {{-- table jadwal kuliah --}}
      <p>Jadwal Kuliah</p>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50px;">No.</th>
            <th scope="col" class="text-center">Mata Kuliah</th>
            <th scope="col" class="text-center">Dosen Pengampu</th>
            <th scope="col" class="text-center">Ruang</th>
            <th scope="col" class="text-center">Hari</th>
            <th scope="col" class="text-center">Jam</th>
          </tr>
        </thead>
        <tbody>
          @php
            $nomor = 0;    
          @endphp
          @if (count($jadwal) <= 0)
              <tr>
                <td colspan="6" class="text-center"> Jadwal Masih Kosong</td>
              </tr>
          @else
          @foreach ($jadwal as $item)    
          <tr>
            <td class="text-center">{{ $nomor+=1 }}</td>
            <td class="text-center">{{ $item->nama_matkul }}</td>
            <td class="text-center">{{ $item->nama_dosen }}</td>
            <td class="text-center">{{ $item->ruang_matkul }}</td>
            <td class="text-center">{{ $item->hari_matkul }}</td>
            <td class="text-center">{{ $item->jam_matkul }}</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
@endsection