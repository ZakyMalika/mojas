@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Dashboard Orang Tua')

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $anakCount ?? 0 }}</h3>
                        <p>Anak Terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <a href="{{ route('parent.anak.index') }}" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $pendaftaranAktifCount ?? 0 }}</h3>
                        <p>Layanan Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <a href="{{ route('parent.pendaftaran-anak.index') }}" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <!-- Jadwal Hari Ini -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks mr-1"></i>
                            Jadwal Anak Hari Ini
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Pantau status perjalanan anak di sini.</p>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Anak</th>
                                    <th>Status</th>
                                    <th>Pengemudi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse($jadwalHariIni as $jadwal)
                               <tr>
                                   <td><strong>{{ \Carbon\Carbon::parse($jadwal->jam_jemput)->format('H:i') }}</strong></td>
                                   <td>{{ $jadwal->anak->nama ?? 'N/A' }}</td>
                                   <td>
                                        @php
                                            $statusMap = ['menunggu' => 'secondary', 'dijemput' => 'info', 'perjalanan' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                                        @endphp
                                        <span class="badge bg-{{ $statusMap[$jadwal->status] ?? 'secondary' }}">{{ ucfirst($jadwal->status) }}</span>
                                   </td>
                                   <td>{{ $jadwal->driver->user->name ?? 'Belum ada' }}</td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="4" class="text-center">Tidak ada jadwal untuk anak Anda hari ini.</td>
                               </tr>
                           @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- right col -->

        </div>
    </div>
@endsection
