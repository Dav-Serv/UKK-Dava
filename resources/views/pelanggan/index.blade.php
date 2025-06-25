@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pelanggan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Data Pelanggan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pembeli</th>
                      <th>Alamat</th>
                      <th>Telephone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pelanggans as $p)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $p->nama_pelanggan }}</td>
                      <td>{{ $p->alamat }}</td>
                      <td>{{ $p->telephone }}</td>
                      <td>
                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-info"><i class="fas fa-pen"></i>Edit</a>
                        <a data-toggle="modal" data-target="#modal-hapus{{ $p->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-hapus{{ $p->id }}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <p>Apakah Kamu Yakin Ingin Menghapus Data Pelanggan</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <form action="{{ route('pelanggan.destroy', $p->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection