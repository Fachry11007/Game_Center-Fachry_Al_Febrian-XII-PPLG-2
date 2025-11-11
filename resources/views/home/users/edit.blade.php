@extends('layouts.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="row">
      <div class="col-xl-8 col-md-10 mx-auto">
        <div class="card">
          <div class="card-header">
            <h3>Edit Data User</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{ $user->name }}" />
                @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="" value="{{ $user->email }}" />
                @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="" />
                @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>
              <button class="btn btn-primary" type="submit">Simpan</button>
              <a class="btn btn-warning" href="{{ route('user.index') }}">Kembali ke Halaman User</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
