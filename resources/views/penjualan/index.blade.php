@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Data Penjualan</li>
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
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah</a>
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
                      <th>Tanggal</th>
                      <th>Pelanggan</th>
                      <th>Total Harga</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($penjualans as $pj)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ \Carbon\Carbon::parse($pj->tanggal_jual)->format('d-m-Y, H:i:s') }}</td>
                      <td>{{ $pj->pelanggan->nama_pelanggan }}</td>
                      <td>{{ "Rp. ".number_format($pj->total_harga) }}</td>
                      @if($pj->status == 0)
                      <td><span class="badge badge-success">Lunas</span></td>
                      @elseif($pj->status == 1)
                      <td><span class="badge badge-warning">Belum Bayar</span></td>
                      @endif
                      <td>
                        @if(in_array(auth()->user()->level, ['admin', 'petugas', 'user']) && $pj->status == 0)
                        <a href="{{ route('penjualan.show', $pj->id) }}" class="btn btn-warning" style="color:white"><i class="fas fa-eye" style="color:white"></i>Lihat Detail</a>
                        @endif
                        @if(in_array(auth()->user()->level, ['admin', 'petugas']) && $pj->status == 1)
                        <a href="{{ route('penjualan.pelunasan', $pj->id) }}" class="btn btn-info"><i class="fas fa-pen"></i>Bayar</a>
                        @endif
                        @if(in_array(auth()->user()->level, ['admin', 'petugas']))
                        <a data-toggle="modal" data-target="#modal-hapus{{ $pj->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                        @elseif(auth()->user()->level == 'user')
                        <a data-toggle="modal" data-target="#modal-cancel{{ $pj->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Tidak Jadi</a>
                        @endif
                      </td>
                    </tr>
                    
                    <!-- modal tidak jadi -->
                    <div class="modal fade" id="modal-cancel{{ $pj->id }}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Cancel Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <p>Apakah Kamu Yakin Ingin MengCancel Data Penjualan</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <form action="{{ route('penjualan.destroy',$pj->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ya, Cancel</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <!-- modal hapus -->
                    <div class="modal fade" id="modal-hapus{{ $pj->id }}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <p>Apakah Kamu Yakin Ingin Menghapus Data Penjualan</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <form action="{{ route('penjualan.destroy',$pj->id) }}" method="post">
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