<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AntarJemput App | Halaman Login</title>
     <link rel="icon" type="image/png" href="{{ asset('images/logomojas.jpg') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
  {{-- Custom CSS for background and enhancements --}}
  <style>
    body.login-page {
        /* background-image: url('https://placehold.co/1920x1080/EBF4FF/737373?text=School+Bus+Background'); */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .login-card-header {
        border-bottom: 0;
        padding-bottom: 0;
    }
    .login-logo i {
        color: #007bff;
        margin-right: 10px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .alert ul {
        margin-bottom: 0;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header login-card-header text-center">
      <a href="#" class="h1 login-logo"><i class="fas fa-shuttle-van"></i><b>MOJAS</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Selamat datang! Silakan login untuk melanjutkan.</p>

      {{-- Menampilkan pesan error validasi dengan lebih baik --}}
      @if ($errors->any())
        <div class="alert alert-danger pb-0">
          <h6><i class="icon fas fa-ban"></i> Gagal Login!</h6>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('login.submit') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="login" class="form-control" placeholder="Username atau Email" value="{{ old('login') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <hr>

      <p class="mb-0 text-center">
        Belum punya akun? <a href="{{ route('register') }}" class="text-center">Daftar sekarang</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
