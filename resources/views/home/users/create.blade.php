@extends('layouts.master')

@section('page-title', 'Tambah User')
@section('page-subtitle', 'Tambah data user baru')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/') }}"> <i class="fa fa-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
    <li class="breadcrumb-item"><a href="#!">Tambah User</a></li>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-xl-8 col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <h3>Tambah User</h3>
        </div>
        <div class="card-body">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id=""
                aria-describedby="helpId" placeholder="" value="{{ old('name') }}" />
        </div>
        @error('name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id=""
                aria-describedby="helpId" placeholder="" value="{{ old('email') }}" />
        </div>
        @error('email')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id=""
                aria-describedby="helpId" placeholder="" />
        </div>
        @error('password')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a class="btn btn-warning" href="{{ route('user.index') }}">Kembali ke Halaman User</a>
    </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
