@extends('layouts.app')

@section('content-title', 'Edit Catatan Penghasilan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Penghasilan ID: #{{ $item->id }}</h3></div>
            <form action="{{ route('admin.penghasilan.update', ['penghasilan' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="driver_id">Pengemudi</label>
                        <select class="form-control" name="driver_id">
                            <option value="{{ $item->driver_id }}" selected>{{ $item->driver->user->name ?? 'Driver tidak ditemukan' }}</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        <select class="form-control" name="jadwal_id">
                           <option value="{{ $item->jadwal_id }}" selected>ID: {{ $item->jadwal_id }} - {{ $item->jadwal->anak->nama ?? 'Jadwal tidak ditemukan' }}</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_per_trip">Tarif per Trip (Rp)</label>
                                <input type="number" class="form-control @error('tarif_per_trip') is-invalid @enderror" name="tarif_per_trip" value="{{ old('tarif_per_trip', $item->tarif_per_trip) }}">
                                @error('tarif_per_trip')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="komisi_pengemudi">Komisi Pengemudi (Rp)</label>
                                <input id="komisi_pengemudi" type="number" step="0.01" class="form-control @error('komisi_pengemudi') is-invalid @enderror" name="komisi_pengemudi" value="{{ old('komisi_pengemudi', $item->komisi_pengemudi) }}">
                                @error('komisi_pengemudi')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Gross, deduction and computed display for edit form --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gross_amount">Angka Penghasilan (Rp)</label>
                                <input id="gross_amount" type="number" step="0.01" class="form-control @error('gross_amount') is-invalid @enderror" name="gross_amount" value="{{ old('gross_amount', $item->komisi_pengemudi) }}" placeholder="Contoh: 25000">
                                @error('gross_amount')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="deduction_percentage">Potongan</label>
                                <select id="deduction_percentage" name="deduction_percentage" class="form-control @error('deduction_percentage') is-invalid @enderror">
                                    <option value="0" {{ old('deduction_percentage') == '0' ? 'selected' : '' }}>Tidak Ada</option>
                                    <option value="5" {{ old('deduction_percentage') == '5' ? 'selected' : '' }}>5%</option>
                                    <option value="10" {{ old('deduction_percentage') == '10' ? 'selected' : '' }}>10%</option>
                                </select>
                                @error('deduction_percentage')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="komisi_akhir_display">Hasil Setelah Potongan (Rp)</label>
                                <input id="komisi_akhir_display" type="text" class="form-control" readonly value="{{ number_format(old('komisi_pengemudi', $item->komisi_pengemudi), 0, ',', '.') }}">
                                <small class="text-muted">Nilai otomatis terisi berdasarkan angka penghasilan dan potongan.</small>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dibayar" {{ old('status', $item->status) == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                </select>
                                @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="tanggal_dibayar">Tanggal Dibayar (Opsional)</label>
                                <input type="date" class="form-control @error('tanggal_dibayar') is-invalid @enderror" name="tanggal_dibayar" value="{{ old('tanggal_dibayar', $item->tanggal_dibayar) }}">
                                @error('tanggal_dibayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.penghasilan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grossInput = document.getElementById('gross_amount');
    const deductionSelect = document.getElementById('deduction_percentage');
    const komisiDisplay = document.getElementById('komisi_akhir_display');
    const komisiInput = document.getElementById('komisi_pengemudi');

    function formatRupiah(value) {
        if (value === null || value === undefined || isNaN(value)) return '';
        return new Intl.NumberFormat('id-ID').format(value);
    }

    function computeKomisi() {
        const gross = parseFloat(grossInput.value) || 0;
        const deduction = parseFloat(deductionSelect.value) || 0;
        const net = gross - (gross * (deduction / 100));
        komisiDisplay.value = net > 0 ? formatRupiah(net) : '';
        if (komisiInput) komisiInput.value = net.toFixed(2);
    }

    if (grossInput) grossInput.addEventListener('input', computeKomisi);
    if (deductionSelect) deductionSelect.addEventListener('change', computeKomisi);

    computeKomisi();
});
</script>
@endpush
