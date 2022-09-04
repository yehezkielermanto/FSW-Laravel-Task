<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SI MAHASISWA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

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

{{-- main content --}}
  <div class="position-relative" style="height: 100vh;">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container card m-4 p-4">
        <form action="/login" method="post">
          @csrf
          <div class="row mb-3">
            <div class="col-4">
              <label for="email" class="col-form-label">Email</label>
            </div>
            <div class="col-8">
              <input type="text" name="email" id="email" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-4">
              <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-8">
              <input type="password" name="password" id="password" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="submit" value="Login" class="btn btn-primary float-end">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script src="https://kit.fontawesome.com/26a7f3b810.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>