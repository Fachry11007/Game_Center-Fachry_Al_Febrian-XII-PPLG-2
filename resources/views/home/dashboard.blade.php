@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<section class="content">
    <div class="row">
        <!-- Statistik Pembelian Bulan Ini -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-green">Rp {{ number_format($totalPembelianBulanIni, 0, ',', '.') }}</h4>
                            <h6 class="text-muted m-b-0">Total Pembelian</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-money f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Bulan Ini</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="fa fa-line-chart text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">{{ $jumlahTransaksiBulanIni }}</h4>
                            <h6 class="text-muted m-b-0">Jumlah Transaksi</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-shopping-cart f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Bulan Ini</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="fa fa-line-chart text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-purple">{{ $historiPembelian->count() }}</h4>
                            <h6 class="text-muted m-b-0">Histori Pembelian</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-history f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-purple">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">1 Bulan Terakhir</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="fa fa-line-chart text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Histori Pembelian -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Histori Pembelian (1 Bulan Terakhir)</h3>
                </div>
                <div class="card-body">
                    @if($historiPembelian->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>ID Akun</th>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historiPembelian as $transaksi)
                                        <tr>
                                            <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $transaksi->id_akun }}</td>
                                            <td>{{ $transaksi->item }}</td>
                                            <td>Rp {{ number_format($transaksi->harga_setelah_diskon, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $transaksi->status == 'success' ? 'success' : ($transaksi->status == 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($transaksi->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pembelian bulan ini</h5>
                            <p class="text-muted">Mulai berbelanja diamond sekarang!</p>
                            <a href="{{ route('diamond.topup') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Top Up Diamond
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Promo Diamond -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Promo Diamond</h3>
                </div>
                <div class="card-body">
                    @foreach($promoDiamond as $promo)
                        <div class="promo-item mb-3 p-3 border rounded">
                            <div class="d-flex align-items-center">
                                <div class="promo-image mr-3">
                                    <img src="{{ asset('assets/images/diamond/' . $promo['gambar']) }}" alt="{{ $promo['nama'] }}" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                                <div class="promo-details flex-grow-1">
                                    <h6 class="mb-1">{{ $promo['nama'] }}</h6>
                                    <div class="price-info">
                                        <small class="text-muted">
                                            <del>Rp {{ number_format($promo['harga_normal'], 0, ',', '.') }}</del>
                                        </small>
                                        <br>
                                        <span class="text-success font-weight-bold">
                                            Rp {{ number_format($promo['harga_promo'], 0, ',', '.') }}
                                        </span>
                                        <span class="badge badge-danger ml-1">{{ $promo['diskon'] }}% OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center mt-3">
                        <a href="{{ route('diamond.topup') }}" class="btn btn-success btn-block">
                            <i class="fa fa-shopping-cart"></i> Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
