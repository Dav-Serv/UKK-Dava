@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @if(in_array(auth()->user()->level, ['admin', 'petugas', 'user']))
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalTransaksiPenjualan }}</h3>

                <p>Total Transaksi</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('penjualan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <!-- ./col -->
           @if(in_array(auth()->user()->level, ['admin', 'petugas']))
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $totalProduk }}</h3>

                <p>Produk Tersedia</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('produk.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <!-- ./col -->
           @if(auth()->user()->level == 'admin')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $totalRegister }}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalPelanggan }}</h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('pelanggan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
         @if(auth()->user()->level == 'admin')
        <div class="content">
          <div class="container-fluid">
          <div class="card-body table-responsive p-0">
            <h1 class="text-center">SELAMAT DATANG DI ADMIN KASIR DAVA</h1>
          </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->level == 'petugas')
        <div class="content">
          <div class="container-fluid">
          <div class="card-body table-responsive p-0">
            <h1 class="text-center">SELAMAT DATANG DI PETUGAS KASIR DAVA</h1>
          </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->level == 'user')
        <div class="content">
          <div class="container-fluid">
          <div class="card-body table-responsive p-0">
            <h1 class="text-center">SELAMAT DATANG DI USER KASIR DAVA</h1>
          </div>
          </div>
        </div>
        @endif
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection