@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Dashboard Pengemudi')

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jadwalHariIni->count() ?? 0 }}</h3>
                        <p>Jadwal Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <a href="{{ route('driver.jadwal.index') }}" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp{{ number_format($penghasilanBulanIni ?? 0, 0, ',', '.') }}</h3>
                        <p>Penghasilan Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <a href="{{ route('driver.penghasilan.index') }}" class="small-box-footer">Lihat Riwayat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                 
            <div class="col-lg-4 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $driver->nomor_plat ?? 'N/A' }}</h3>
                        <p>Kendaraan Anda</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Jadwal Hari Ini -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks mr-1"></i>
                            Tugas Antar Jemput Hari Ini
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Anak</th>
                                    <th>Status</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalHariIni as $jadwal)
                               <tr>
                                   <td><strong>{{ \Carbon\Carbon::parse($jadwal->jam_jemput)->format('H:i') }}</strong></td>
                                   <td>{{ $jadwal->anak->nama ?? 'N/A' }}</td>
                                   <td>
                                        @php
                                            $statusMap = ['menunggu' => 'secondary', 'dijemput' => 'info', 'perjalanan' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                                        @endphp
                                        <span class="badge bg-{{ $statusMap[$jadwal->status] ?? 'secondary' }}">{{ ucfirst($jadwal->status) }}</span>
                                   </td>
                                   <td>
                                       <a href="{{ route('driver.jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm btn-block">
                                           <i class="fas fa-edit"></i> Update
                                       </a>
                                   </td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="4" class="text-center">Tidak ada jadwal untuk hari ini.</td>
                               </tr>
                           @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('driver.jadwal.index') }}">Lihat Semua Jadwal</a>
                    </div>
                </div>
            </section>

            <!-- right col -->

        </div>
    </div>
@endsection
