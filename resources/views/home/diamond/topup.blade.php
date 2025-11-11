@extends('layouts.master')

@section('title', 'Top Up Diamond')
@section('page-title', 'Top Up Diamond')
@section('page-subtitle', 'Pilih paket diamond yang ingin dibeli')
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
          <h3>Top Up Diamond</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form untuk input ID Akun dan Pilih Paket -->
            <form action="{{ route('transaksi.create') }}" method="POST" id="topupForm">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="id_akun" class="form-label">Masukkan ID Akun Game Anda</label>
                        <input type="text" class="form-control" name="id_akun" id="id_akun"
                               value="{{ old('id_akun') }}" placeholder="Contoh: 123456789" required>
                        @error('id_akun')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="Pulsa" {{ old('metode_pembayaran') == 'Pulsa' ? 'selected' : '' }}>Pulsa</option>
                            <option value="Kartu Kredit" {{ old('metode_pembayaran') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Paket Diamond Cards -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label">Pilih Paket Diamond</label>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card diamond-package" data-value="100|25000">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/images/diamond/diamond-100.png') }}" alt="100 Diamond" class="img-fluid mb-2" style="max-height: 60px;" onerror="this.src='{{ asset('assets/images/logo.png') }}'">
                                        <h5 class="card-title">100 Diamond</h5>
                                        <p class="card-text text-success fw-bold">Rp 25.000</p>
                                        <p class="text-muted small">Diskon 20%: Rp 20.000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card diamond-package" data-value="500|125000">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/images/diamond/diamond-500.png') }}" alt="500 Diamond" class="img-fluid mb-2" style="max-height: 60px;" onerror="this.src='{{ asset('assets/images/logo.png') }}'">
                                        <h5 class="card-title">500 Diamond</h5>
                                        <p class="card-text text-success fw-bold">Rp 125.000</p>
                                        <p class="text-muted small">Diskon 20%: Rp 100.000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card diamond-package" data-value="1000|250000">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/images/diamond/diamond-1000.png') }}" alt="1000 Diamond" class="img-fluid mb-2" style="max-height: 60px;" onerror="this.src='{{ asset('assets/images/logo.png') }}'">
                                        <h5 class="card-title">1000 Diamond</h5>
                                        <p class="card-text text-success fw-bold">Rp 250.000</p>
                                        <p class="text-muted small">Diskon 20%: Rp 200.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="paket" id="paket" value="{{ old('paket') }}" required>
                        @error('paket')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                            <i class="fa fa-shopping-cart"></i> Beli Diamond
                        </button>
                    </div>
                </div>
            </form>

            <div class="alert alert-info">
                <strong>Informasi:</strong>
                <ul class="mb-0">
                    <li>Harga diamond: Rp 25.000 per 100 diamond</li>
                    <li>Diskon otomatis 20% untuk semua pembelian</li>
                    <li>Pastikan ID akun game Anda sudah benar</li>
                    <li>Setelah pembelian berhasil, data akan langsung masuk ke detail transaksi</li>
                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.diamond-package {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.diamond-package:hover {
    border-color: #007bff;
    box-shadow: 0 4px 8px rgba(0,123,255,0.2);
}

.diamond-package.selected {
    border-color: #28a745;
    background-color: #f8fff9;
}

.diamond-package img {
    max-width: 80px;
    height: auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle diamond package selection
    const diamondPackages = document.querySelectorAll('.diamond-package');
    const paketInput = document.getElementById('paket');

    diamondPackages.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            diamondPackages.forEach(c => c.classList.remove('selected'));
            // Add selected class to clicked card
            this.classList.add('selected');
            // Set the value to hidden input
            paketInput.value = this.dataset.value;
        });
    });

    // Set initial selection if old value exists
    if (paketInput.value) {
        const selectedCard = document.querySelector(`.diamond-package[data-value="${paketInput.value}"]`);
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
    }

    // Form validation
    document.getElementById('topupForm').addEventListener('submit', function(e) {
        const idAkun = document.getElementById('id_akun').value.trim();
        const paket = document.getElementById('paket').value;
        const metode = document.getElementById('metode_pembayaran').value;

        if (!idAkun) {
            e.preventDefault();
            alert('Silakan masukkan ID Akun terlebih dahulu');
            return;
        }

        // Validasi ID akun (hanya angka)
        if (!/^\d+$/.test(idAkun)) {
            e.preventDefault();
            alert('ID Akun hanya boleh berisi angka');
            return;
        }

        if (!paket) {
            e.preventDefault();
            alert('Silakan pilih paket diamond');
            return;
        }

        if (!metode) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran');
            return;
        }

        // Disable button saat submit
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';
    });
});
</script>
@endsection
