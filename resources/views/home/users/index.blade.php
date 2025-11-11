@extends('layouts.master')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xl-8 col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
            @if (session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif
          <h3>Game Center
            <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah Data User</a></h3>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="max-height: 400px;">
            <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user as $u)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
    <a class="btn btn-warning" href="{{ route('user.edit', $u->id) }}">Edit</a>
    <a class="btn btn-danger"
       onclick="return confirm('Yakin mau hapus data ini ?')"
       href="{{ route('user.destroy', $u->id) }}">Hapus</a>
</td>
            </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
