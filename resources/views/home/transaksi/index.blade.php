@extends('layouts.master')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi')
@section('page-subtitle', 'Kelola data transaksi')
@section('breadcrumb')
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3>Daftar Transaksi</h3>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Akun</th>
                  <th>Item</th>
                  <th>Metode Pembayaran</th>
                  <th>Jumlah Diamond</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($transaksis as $transaksi)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->id_akun }}</td>
                    <td>{{ $transaksi->item }}</td>
                    <td>{{ $transaksi->metode_pembayaran }}</td>
                    <td>{{ $transaksi->jumlah_diamond }}</td>
                    <td>Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->diskon }}%</td>
                    <td>Rp {{ number_format($transaksi->harga_setelah_diskon, 0, ',', '.') }}</td>
                    <td>
                      <span class="badge badge-{{ $transaksi->status == 'success' ? 'success' : ($transaksi->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($transaksi->status) }}
                      </span>
                    </td>
                    <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                      <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                      </a>
                      <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center">Belum ada data transaksi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($transaksis->hasPages())
            <div class="d-flex justify-content-center">
              {{ $transaksis->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
