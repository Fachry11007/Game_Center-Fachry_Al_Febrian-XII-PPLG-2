@extends('layouts.master')

@section('title', 'Edit Transaksi')
@section('page-title', 'Edit Transaksi')
@section('page-subtitle', 'Edit data transaksi')
@section('breadcrumb')
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3>Edit Transaksi</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="id_akun" class="form-label">ID Akun Game</label>
                  <input type="text" class="form-control" name="id_akun" id="id_akun" value="{{ old('id_akun', $transaksi->id_akun) }}" required>
                  @error('id_akun')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="item" class="form-label">Item/Paket</label>
                  <input type="text" class="form-control" name="item" id="item" value="{{ old('item', $transaksi->item) }}" required>
                  @error('item')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                  <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="Transfer Bank" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="E-Wallet" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="Pulsa" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Pulsa' ? 'selected' : '' }}>Pulsa</option>
                    <option value="Kartu Kredit" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                  </select>
                  @error('metode_pembayaran')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="jumlah_diamond" class="form-label">Jumlah Diamond</label>
                  <input type="number" class="form-control" name="jumlah_diamond" id="jumlah_diamond" value="{{ old('jumlah_diamond', $transaksi->jumlah_diamond) }}" required>
                  @error('jumlah_diamond')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option value="pending" {{ old('status', $transaksi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="success" {{ old('status', $transaksi->status) == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="failed" {{ old('status', $transaksi->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                  </select>
                  @error('status')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="alert alert-info">
              <strong>Info Harga:</strong> Harga otomatis Rp 25.000 per 100 diamond.<br>
              <strong>Info Diskon:</strong> Semua transaksi mendapat diskon otomatis 20%.
            </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary ms-2">Kembali</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
