<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penghasilan Pengemudi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead th {
            background-color: #4472C4;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #333;
        }
        table tbody td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            font-size: 10px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            color: white;
        }
        .status-pending { background-color: #ffc107; color: #333; }
        .status-dibayar { background-color: #28a745; color: white; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penghasilan Pengemudi</h1>
        <p>Tanggal: {{ date('d/m/Y H:i:s') }}</p>
        
        @if(isset($isAllData) && $isAllData === true)
            <!-- EKSPOR SEMUA DATA -->
            <p style="color: #27ae60; font-weight: bold; font-size: 14px;">✓ EKSPOR LENGKAP - SEMUA DATA</p>
            <p>Total Penghasilan: <strong>{{ isset($totalCount) ? $totalCount : count($items) }}</strong> (Tanpa Batasan Halaman)</p>
        @elseif(isset($isCurrentPage) && $isCurrentPage === true && $items instanceof \Illuminate\Pagination\Paginator)
            <!-- EKSPOR HALAMAN SAAT INI -->
            <p style="color: #e74c3c;">Halaman {{ $items->currentPage() }} dari {{ $items->lastPage() }}</p>
            <p>Data Halaman Ini: <strong>{{ $items->count() }}</strong> | Total: {{ $items->total() }}</p>
        @else
            <!-- FALLBACK -->
            <p>Total Data: <strong>{{ count($items) }}</strong> Item</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pengemudi</th>
                <th>Anak</th>
                <th>Tanggal Jadwal</th>
                <th>Tipe Layanan</th>
                <th style="text-align: right;">Komisi (Rp)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                @php
                    $statusClass = $item->status == 'dibayar' ? 'status-dibayar' : 'status-pending';
                    $pendaftaran = $item->jadwal->anak->pendaftaran_anak->first();
                    $tipe_layanan = $pendaftaran ? $pendaftaran->tipe_layanan : null;
                    
                    $formatted_layanan = 'N/A';
                    if ($tipe_layanan === 'one_way') {
                        $formatted_layanan = 'One Way';
                    } elseif ($tipe_layanan === 'two_way') {
                        $formatted_layanan = 'Two Way';
                    }
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->driver->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->jadwal->anak->nama ?? 'N/A' }}</td>
                    <td>{{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d M Y') : 'N/A' }}</td>
                    <td>{{ $formatted_layanan }}</td>
                    <td class="text-right">{{ number_format($item->komisi_pengemudi, 0, ',', '.') }}</td>
                    <td><span class="status-badge {{ $statusClass }}">{{ ucfirst($item->status) }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data penghasilan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem manajemen penghasilan pengemudi.</p>
    </div>
</body>
</html>
