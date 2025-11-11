@extends('layouts.master')

@section('title', 'Struk Pembelian Diamond')
@section('page-title', 'Struk Pembelian Diamond')
@section('page-subtitle', 'Struk transaksi #' . $transaksi->id)
@section('breadcrumb')
@endsection
@section('content')
<section class="content">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Struk Pembelian -->
      <div class="card border-primary">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0"><i class="fa fa-receipt"></i> STRUK PEMBELIAN DIAMOND</h4>
          <small>Game Center - Top Up Diamond</small>
        </div>
        <div class="card-body">
          <!-- Header Struk -->
          <div class="text-center mb-4">
            <h5>Transaksi #{{ $transaksi->id }}</h5>
            <p class="text-muted">{{ $transaksi->created_at->format('d F Y, H:i:s') }}</p>
          </div>

          <!-- Informasi Pembeli -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="border-bottom pb-2">
                <strong>Informasi Pembeli:</strong>
              </div>
              <div class="mt-2">
                <p class="mb-1"><strong>ID Akun Game:</strong> {{ $transaksi->id_akun }}</p>
                <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ $transaksi->metode_pembayaran }}</p>
              </div>
            </div>
          </div>

          <!-- Detail Pembelian -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="border-bottom pb-2">
                <strong>Detail Pembelian:</strong>
              </div>
              <div class="mt-2">
                <div class="row">
                  <div class="col-8">
                    <p class="mb-1"><strong>Paket Diamond:</strong></p>
                    <p class="text-primary">{{ $transaksi->item }}</p>
                  </div>
                  <div class="col-4 text-right">
                    <p class="mb-1"><strong>Jumlah:</strong></p>
                    <p>{{ $transaksi->jumlah_diamond }} Diamond</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Rincian Harga -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="border-bottom pb-2">
                <strong>Rincian Harga:</strong>
              </div>
              <div class="mt-2">
                <table class="table table-sm table-borderless">
                  <tr>
                    <td>Harga Dasar:</td>
                    <td class="text-right">Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <td>Diskon ({{ $transaksi->diskon }}%):</td>
                    <td class="text-right text-success">- Rp {{ number_format($transaksi->jumlah_diskon, 0, ',', '.') }}</td>
                  </tr>
                  <tr class="border-top">
                    <td><strong>Total Pembayaran:</strong></td>
                    <td class="text-right"><strong class="text-primary">Rp {{ number_format($transaksi->harga_setelah_diskon, 0, ',', '.') }}</strong></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <!-- Status Pembayaran -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="border-bottom pb-2">
                <strong>Status Pembayaran:</strong>
              </div>
              <div class="mt-2 text-center">
                <span class="badge badge-lg badge-{{ $transaksi->status == 'success' ? 'success' : ($transaksi->status == 'pending' ? 'warning' : 'danger') }} p-2">
                  <i class="fa fa-{{ $transaksi->status == 'success' ? 'check-circle' : ($transaksi->status == 'pending' ? 'clock' : 'times-circle') }}"></i>
                  {{ ucfirst($transaksi->status) }}
                </span>
              </div>
            </div>
          </div>

          <!-- Footer Struk -->
          <div class="row">
            <div class="col-12 text-center">
              <div class="border-top pt-3">
                <p class="mb-1"><strong>Terima Kasih Telah Berbelanja!</strong></p>
                <p class="text-muted small">Diamond akan segera ditambahkan ke akun game Anda</p>
                <p class="text-muted small">Untuk informasi lebih lanjut, hubungi customer service kami</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="fa fa-print"></i> Cetak Struk
          </button>
          <a href="{{ route('transaksi.index') }}" class="btn btn-secondary ml-2">
            <i class="fa fa-arrow-left"></i> Kembali ke Daftar Transaksi
          </a>
          <a href="{{ route('diamond.topup') }}" class="btn btn-success ml-2">
            <i class="fa fa-plus"></i> Beli Lagi
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
@media print {
  .card-footer {
    display: none;
  }
  .btn {
    display: none;
  }
  body {
    background: white !important;
  }
  .card {
    border: none !important;
    box-shadow: none !important;
  }
}
</style>
@endsection
