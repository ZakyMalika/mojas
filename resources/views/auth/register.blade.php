<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AntarJemput App | Halaman Registrasi</title>

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
    body.register-page {
        /* background-image: url('https://placehold.co/1920x1080/EBF4FF/737373?text=School+Bus+Background'); */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .register-card-header {
        border-bottom: 0;
        padding-bottom: 0;
    }
    .register-logo i {
        color: #007bff;
        margin-right: 10px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .alert ul {
        margin-bottom: 0;
        list-style: none;
        padding-left: 0;
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header register-card-header text-center">
      <a href="#" class="h1 register-logo"><i class="fas fa-shuttle-van"></i><b>Antar</b>Jemput</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftarkan akun baru Anda</p>

      {{-- Menampilkan pesan error validasi --}}
      @if ($errors->any())
        <div class="alert alert-danger pb-0">
          <h6><i class="icon fas fa-ban"></i> Gagal Registrasi!</h6>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.submit') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
         <div class="input-group mb-3">
          <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        {{-- Penambahan Role Selector --}}
        <div class="input-group mb-3">
            <select name="role" class="form-control" required>
                <option value="">Daftar sebagai...</option>
                <option value="orang_tua" {{ old('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="pengemudi" {{ old('role') == 'pengemudi' ? 'selected' : '' }}>Pengemudi</option>
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tag"></span>
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
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <hr>

      <p class="mb-0 text-center">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-center">Login di sini</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
</body>
</html>

