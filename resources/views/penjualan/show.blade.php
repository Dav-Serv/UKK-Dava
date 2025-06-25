@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Data Detail Penjualan</li>
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
          <div class="container">
            <p><strong>ID Penjualan:</strong> {{ $penjualan->id }}</p>
            <p><strong>Tanggal Penjualan:</strong> {{ \Carbon\Carbon::parse($penjualan->tanggal_jual)->format('D d-m-Y, H:i:s') }}</p>
            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</p>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Harga Satuan</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($penjualan->detailpenjualan as $detail)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $detail->produk->nama_produk }}</td>
                      <td>{{ $detail->jumlah_produk }}</td>
                      <td>{{ "Rp. ".number_format($detail->produk->harga) }}</td>
                      <td>{{ "Rp. ".number_format($detail->subtotal) }}</td>
                      <td>
                        
                      </td>
                    </tr>
                    <!-- /.modal -->
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Total Penjualan:</strong></td>
                        <td>{{ "Rp. ".number_format($penjualan->total_harga) }}</td>
                    </tr>
                    <tr>
                        <td><a href="{{ route('penjualan.kwitansi', $penjualan->id) }}" class="btn btn-primary" style="color:white"><i class="fas fa-print" style="color:white"></i> Cetak</a></td>
                    </tr>
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