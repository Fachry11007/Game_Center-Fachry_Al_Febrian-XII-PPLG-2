@extends('layouts.master')

@section('title', 'Konfirmasi Pembelian Diamond')
@section('page-title', 'Konfirmasi Pembelian Diamond')
@section('page-subtitle', 'Lengkapi detail pembelian diamond')
@section('breadcrumb')
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            @if (session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif
          <h3>Konfirmasi Pembelian Diamond</h3>
        </div>
        <div class="card-body">

            <!-- Ringkasan Pembelian -->
            <div class="alert alert-info">
                <h5>Ringkasan Pembelian</h5>
                <p><strong>ID Akun:</strong> {{ request('id_akun') }}</p>
                <p><strong>Paket:</strong> {{ request('item') }}</p>
                <p><strong>Jumlah Diamond:</strong> {{ request('jumlah_diamond') }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format(request('harga'), 0, ',', '.') }}</p>
                <p><strong>Diskon:</strong> 20%</p>
                <p><strong>Total Bayar:</strong> Rp {{ number_format(request('harga') * 0.8, 0, ',', '.') }}</p>
            </div>

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <!-- Hidden fields untuk data dari topup -->
    <input type="hidden" name="id_akun" value="{{ request('id_akun') }}">
    <input type="hidden" name="item" value="{{ request('item') }}">
    <input type="hidden" name="jumlah_diamond" value="{{ request('jumlah_diamond') }}">
    <input type="hidden" name="harga" value="{{ request('harga') }}">

    <div class="mb-3">
        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
        <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
            <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
            <option value="Pulsa" {{ old('metode_pembayaran') == 'Pulsa' ? 'selected' : '' }}>Pulsa</option>
        </select>
        @error('metode_pembayaran')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Status otomatis di-set ke Pending -->
    <input type="hidden" name="status" value="Pending">

    <div class="d-flex gap-2">
        <button class="btn btn-success btn-lg" type="submit">
            <i class="fa fa-check"></i> Konfirmasi Pembelian
        </button>
        <a href="{{ route('diamond.topup') }}" class="btn btn-secondary btn-lg">
            <i class="fa fa-times"></i> Batal
        </a>
    </div>
    <a class="btn btn-warning" href="{{ route('diamond.topup') }}?id_akun={{ request('id_akun') }}">
        <i class="fa fa-arrow-left"></i> Kembali Pilih Paket
    </a>
</form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
