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
              <li class="breadcrumb-item active">Edit Penjualan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('penjualan.lunas', $penjualan->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Penjualan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div>
                    <div class="card-body">
                    <div class="form-group">
                        <label for="pelanggan">Nama Pelanggan</label>
                        <select class="form-control" id="pelanggan" name="pelanggan" disabled>
                          <option value="">-Pilih Nama Pelanggan-</option>
                          @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}" {{ $penjualan->id_pelanggan == $p->id ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                          @endforeach
                        </select>
                        @error('pelanggan')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <h3>Produk</h3>
                    @foreach($penjualan->detailPenjualan as $detail)
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" placeholder="Enter nama" value="{{ $detail->produk->nama_produk }}" disabled>
                    @endforeach
                    <div id="produk-container">
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary" >Bayar</button>
                    </div>
                    
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    </div>
                </div>
                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->
            </div>
        </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
