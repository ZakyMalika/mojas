<?php

namespace App\Exports;

use App\Models\Penghasilan_driver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenghasilanDriverExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = Penghasilan_driver::with(['driver.user', 'jadwal.anak']);
        
        if ($this->search) {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                  ->orWhereHas('driver.user', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('jadwal.anak', function($subQuery) use ($search) {
                      $subQuery->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $penghasilan = $query->latest()->get();

        return $penghasilan->map(function($item, $index) {
            $pendaftaran = $item->jadwal->anak->pendaftaran_anak->first();
            $tipe_layanan = $pendaftaran ? $pendaftaran->tipe_layanan : null;
            
            $formatted_layanan = 'N/A';
            if ($tipe_layanan === 'one_way') {
                $formatted_layanan = 'One Way';
            } elseif ($tipe_layanan === 'two_way') {
                $formatted_layanan = 'Two Way';
            }

            return [
                'No' => $index + 1,
                'Pengemudi' => $item->driver->user->name ?? 'N/A',
                'Anak' => $item->jadwal->anak->nama ?? 'N/A',
                'Tanggal' => $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d/m/Y') : 'N/A',
                'Tipe Layanan' => $formatted_layanan,
                'Tarif Per Trip' => $item->tarif_per_trip ?? 0,
                'Komisi Pengemudi' => $item->komisi_pengemudi ?? 0,
                'Status' => ucfirst($item->status),
                'Tanggal Dibayar' => $item->tanggal_dibayar ? \Carbon\Carbon::parse($item->tanggal_dibayar)->format('d/m/Y') : '-'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Pengemudi',
            'Anak',
            'Tanggal',
            'Tipe Layanan',
            'Tarif Per Trip',
            'Komisi Pengemudi',
            'Status',
            'Tanggal Dibayar'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
            ],
        ];
    }
}
