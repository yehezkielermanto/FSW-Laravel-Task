<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cetak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
  <div class="container m-4">
    <a href="/admin/mahasiswa" class="btn btn-secondary my-3">Back</a>
    {{-- button cetak --}}
    <button onclick="return print()" class="btn btn-primary my-3">Cetak</button>
    
    <div id="content">
      <div class="card p-3">
        @foreach ($mahasiswa as $mhs)
            <p>Nama: {{ $mhs->nama_mahasiswa }}</p>
            <p>Prodi: {{ $mhs->nama_prodi }}</p>
        @endforeach
      </div>
      {{-- table jadwal --}}
      <table class="table table-bordered table-striped mt-4">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Matkul</th>
            <th class="text-center">Dosen Pendamping</th>
            <th class="text-center">Ruangan</th>
            <th class="text-center">Hari</th>
            <th class="text-center">waktu</th>
          </tr>
        </thead>
        <tbody>
          @php
              $nomor = 0;
          @endphp
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
        </tbody>
      </table>
    </div>
  </div>

  <!-- script print page to pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
  <script src="https://kit.fontawesome.com/26a7f3b810.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function print(){
      var filename = 'jadwalKuliah';
      var prtContent = document.getElementById("content");
      var opt = {
        margin:       1,
        filename:     `${filename}.pdf`,
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'p' }
      };
      // New Promise-based usage:
      html2pdf().set(opt).from(prtContent).save();
    }
  </script>
</body>
</html>