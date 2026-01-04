@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalParents ?? 0 }}</h3>
                    <p>Orang Tua Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalDrivers ?? 0 }}</h3>
                    <p>Pengemudi Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car-side"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $totalAnaks ?? 0 }}</h3>
                    <p>Total Anak</p>
                </div>
                <div class="icon">
                    <i class="fas fa-child"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalUnpaidDrivers ?? 0 }}</h3>
                    <p>Driver Belum Dibayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- /.row -->

    <!-- Grafik -->
    
    
    <!-- Table Unpaid Drivers -->
    <div class="row">
        <div class="col-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Driver Belum Dibayar</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th>Driver</th>
                                    <th>Total Tagihan</th>
                                    <th>Jumlah Trip Pending</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unpaidDriversData as $unpaid)
                                    <tr>
                                        <td>{{ $unpaid->driver->user->name ?? 'N/A' }}</td>
                                        <td><strong>Rp{{ number_format($unpaid->total_pending, 0, ',', '.') }}</strong></td>
                                        <td>{{ $unpaid->pending_count }} Trip</td>
                                        <td>
                                            <a href="{{ route('admin.penghasilan.index', ['driver_id' => $unpaid->driver_id, 'status' => 'pending']) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Semua driver sudah dibayar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row">
        <div class="col-lg-6">
             <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Pendaftaran Terbaru</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>ID Anak</th>
                                <th>Nama Anak</th>
                                <th>Status</th>
                                <th>Orang Tua</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaranTerbaru as $pendaftaran)
                                <tr>
                                    <td><a href="{{ route('admin.anak.show', $pendaftaran->id) }}">#{{ $pendaftaran->id }}</a></td>
                                    <td>{{ $pendaftaran->anak->nama ?? 'N/A' }}</td>
                                    <td>
                                        @php $statusMap = ['pending' => 'warning', 'lunas' => 'success', 'expired' => 'danger']; @endphp
                                        <span class="badge badge-{{ $statusMap[$pendaftaran->status] ?? 'secondary' }}">{{ ucfirst($pendaftaran->status) }}</span>
                                    </td>
                                    <td>{{ $pendaftaran->anak->orangTua->user->name ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center">Tidak ada pendaftaran baru.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.pendaftaran-anak.index') }}">Lihat Semua Pendaftaran</a>
                </div>
            </div>
        </div>
         <div class="col-lg-6">
             <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Pembayaran Terbaru</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>ID Pembayaran</th>
                                <th>Anak</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                               @forelse($pembayaranTerbaru as $pembayaran)
                                <tr>
                                    <td><a href="{{ route('admin.pembayaran.show', $pembayaran->id) }}">#{{ $pembayaran->id }}</a></td>
                                    <td>{{ $pembayaran->pendaftaran_anak->anak->nama ?? 'N/A' }}</td>
                                    <td>Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                     <td>
                                        @php $statusMap = ['pending' => 'warning', 'sukses' => 'success', 'gagal' => 'danger']; @endphp
                                        <span class="badge badge-{{ $statusMap[$pembayaran->status] ?? 'secondary' }}">{{ ucfirst($pembayaran->status) }}</span>
                                    </td>
                                </tr>
                               @empty
                                <tr><td colspan="4" class="text-center">Tidak ada pembayaran baru.</td></tr>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.pembayaran.index') }}">Lihat Semua Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Memuat library Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(function () {
    'use strict'

    // Data dari Controller
    var userRoleData = {!! json_encode($userRoleData ?? []) !!};
    var pendaftaranData = {!! json_encode($pendaftaran7Hari ?? []) !!};

    //-------------
    //- PIE CHART - (Komposisi Pengguna)
    //-------------
    var pieChartCanvas = $('#userRoleChart').get(0).getContext('2d')
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: {
            labels: Object.keys(userRoleData),
            datasets: [{
                data: Object.values(userRoleData),
                backgroundColor : ['#f56954', '#00c0ef', '#f39c12'],
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                position: 'right',
            }
        }
    });

    //-------------
    //- BAR CHART - (Pendaftaran Terbaru)
    //-------------
    var barChartCanvas = $('#pendaftaranChart').get(0).getContext('2d')
    new Chart(barChartCanvas, {
      type: 'bar',
      data: {
        labels: pendaftaranData.labels,
        datasets: [
          {
            label: 'Pendaftaran Baru',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: pendaftaranData.data
          },
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                     stepSize: 1 // Hanya tampilkan angka bulat
                }
            }]
        }
      }
    })
});
</script>
@endpush

