<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link"> {{-- Tautan ini bisa diarahkan ke dashboard masing-masing role --}}
         <img src="{{ asset('images/logomojas.jpg') }}" alt="Logo MOJAS Batam"
                        style="height: 50px; width: auto;">
        <span class="brand-text font-weight-light ">MOJAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ Auth::user()->avatar ?? 'dist/img/user2-160x160.jpg' }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                {{-- Menampilkan nama user yang sedang login --}}
                <a href="/{{ Auth::user()->role }}" class="d-block">{{ Auth::user()->name ?? 'Guest User' }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Cek apakah user sudah login --}}
                @auth

                {{-- ================================================= --}}
                {{-- ============== MENU UNTUK ADMIN =============== --}}
                {{-- ================================================= --}}
                @if(Auth::user()->role == 'admin')
                
                    <li class="nav-item">
                        {{-- Pastikan route ini ada dan bernama 'admin.dashboard' di web.php --}}
                        <a href="/admin" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">MANAJEMEN DATA</li>

                    @php
                        $isUserManagementActive = request()->routeIs('admin.orang-tua.*') || 
                                                  request()->routeIs('admin.drivers.*') || 
                                                  request()->routeIs('admin.anak.*');
                    @endphp
                    <li class="nav-item {{ $isUserManagementActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $isUserManagementActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Kelola Pengguna
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orang_tua.index') }}" class="nav-link {{ request()->routeIs('admin.orang_tua.*') ? 'active' : '' }}">
                                    <i class="fas fa-user-friends nav-icon"></i>
                                    <p>Orang Tua</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.drivers.index') }}" class="nav-link {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
                                    <i class="fas fa-car-side nav-icon"></i>
                                    <p>Pengemudi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.anak.index') }}" class="nav-link {{ request()->routeIs('admin.anak.*') ? 'active' : '' }}">
                                    <i class="fas fa-child nav-icon"></i>
                                    <p>Anak</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tarif-jarak.index') }}" class="nav-link {{ request()->routeIs('admin.tarif-jarak.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>Tarif Jarak</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pengguna Sistem</p>
                        </a>
                    </li>

                    <li class="nav-header">OPERASIONAL</li>
                     <li class="nav-item">
                        <a href="{{ route('admin.pendaftaran-anak.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran-anak.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Pendaftaran Umum</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.schools.index') }}" class="nav-link {{ request()->routeIs('admin.schools.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-school"></i>
                            <p>Mitra</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.jadwal.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Antar Jemput</p>
                        </a>
                    </li>

                    <li class="nav-header">KEUANGAN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pembayaran.index') }}" class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Pembayaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.penghasilan.index') }}" class="nav-link {{ request()->routeIs('admin.penghasilan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Penghasilan Driver</p>
                        </a>
                    </li>

                    {{-- <li class="nav-header">LAPORAN & LOG</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.log-jadwal.index') }}" class="nav-link {{ request()->routeIs('admin.log-jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Log Jadwal</p>
                        </a>
                    </li> --}}
                
                {{-- ================================================= --}}
                {{-- =========== MENU UNTUK PENGEMUDI ============== --}}
                {{-- ================================================= --}}
                @elseif(Auth::user()->role == 'pengemudi')
                    <li class="nav-item">
                        {{-- Pastikan Anda menamai route '/driver' di web.php, contoh: ->name('driver.dashboard') --}}
                        <a href="/pengemudiCan I be? Play Karna FM. OK. I. Or. Hello. I think. Kombke Ki kuliya kamai MMM. The Mao Mongayan. Hey, Cortana. Yeah. Chhattisgarh. Prokh Abdi ustas. The. " class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">MENU UTAMA</li>
                    <li class="nav-item">
                        <a href="{{ route('driver.jadwal.index') }}" class="nav-link {{ request()->routeIs('driver.jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Jadwal Hari Ini</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('driver.penghasilan.index') }}" class="nav-link {{ request()->routeIs('driver.penghasilan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>Penghasilan Saya</p>
                        </a>
                    </li>
                     {{-- <li class="nav-item">
                        <a href="{{ route('driver.log-jadwal.index') }}" class="nav-link {{ request()->routeIs('driver.log-jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Perjalanan</p>
                        </a>
                    </li> --}}

                {{-- ================================================= --}}
                {{-- ============ MENU UNTUK ORANG TUA ============= --}}
                {{-- ================================================= --}}
                @elseif(Auth::user()->role == 'orang_tua')
                    <li class="nav-item">
                        {{-- Pastikan Anda menamai route '/orang_tua' di web.php, contoh: ->name('orang_tua.dashboard') --}}
                        <a href="/orang_tua" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                     <li class="nav-header">MENU UTAMA</li>
                    <li class="nav-item">
                        <a href="{{ route('parent.anak.index') }}" class="nav-link {{ request()->routeIs('parent.anak.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-child"></i>
                            <p>Data Anak Saya</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('parent.pendaftaran-anak.index') }}" class="nav-link {{ request()->routeIs('parent.pendaftaran-anak.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Pendaftaran Anak</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('parent.pembayaran.index') }}" class="nav-link {{ request()->routeIs('parent.pembayaran.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>Riwayat Pembayaran</p>
                        </a>
                    </li> --}}
                    {{-- Route untuk 'Jadwal Anak' dan 'Riwayat' tidak terdefinisi di web.php untuk role orang_tua --}}
                    <li class="nav-item">
                        <a href="{{ route('parent.jadwal.index') }}" class="nav-link {{ request()->routeIs('parent.jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Anak</p>
                        </a>
                    </li>
                     {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Antar Jemput</p>
                        </a>
                    </li>  --}}
                @endif
                
                {{-- Menu Logout, tampil untuk semua role yang login --}}
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
