<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('index.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/admin">SI MAHASISWA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav w-100">
          <a class="nav-link" href="/mahasiswa">Mahasiswa</a>
        </div>
        <div class="w-100 link-logout">
          <a class="nav-link" href="/logout">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container mt-4">
    <p>Nama: {{ session()->get('nama') }}</p>
    <p class="mb-4">Prodi: {{ session()->get('prodi') }}</p>
    <h5>Jadwal Kuliah</h5>
    <table class="table table-bordered table-stripped">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="width: 50px;">No</th>
          <th scope="col" class="text-center">Nama Mata Kuliah</th>
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
          @foreach ($jadwal as $item)              
          <tr>
            <td class="center">{{ $nomor+=1 }}</td>
            <td class="center">{{ $item->nama_matkul }}</td>
            <td class="center">{{ $item->nama_dosen }}</td>
            <td class="center">{{ $item->ruang_matkul }}</td>
            <td class="center">{{ $item->hari_matkul }}</td>
            <td class="center">{{ $item->jam_matkul }}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://kit.fontawesome.com/26a7f3b810.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>