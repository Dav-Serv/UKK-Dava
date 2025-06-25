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
              <li class="breadcrumb-item active">Tambah Penjualan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('penjualan.store') }}" method="post">
            @csrf
            <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div caass="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Penjualan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pelanggan</label>
                        <select class="form-control" id="exampleInputEmail1" name="pelanggan">
                          <option value="">-Pilih Nama Pelanggan-</option>
                          @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                          @endforeach
                        </select>
                        @error('pelanggan')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <h3>Produk</h3>
                    @if($produks->count() > 0)
                    <button type="button" id="add-produk" class="btn btn-secondary">Tambah Produk</button>
                    <div id="produk-container">
                    </div>
                    @else
                      <p>Data Produk Tidak Ditemukan.</p>
                    @endif
                    <br><br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    </div>
                </form>
                <script>
                        let produkIndex = 1;
                        document.getElementById('add-produk').addEventListener('click', function () {
                            const produkContainer = document.getElementById('produk-container');
                            const newProdukItem = document.createElement('div');
                            newProdukItem.classList.add('produk-item');
                            newProdukItem.innerHTML = `
                                <div class="form-group">
                                    <label for="produk[${produkIndex}][ProdukID]">Pilih Produk:</label>
                                    <select name="produk[${produkIndex}][ProdukID]" class="form-control" required>
                                        @foreach($produks as $pd)
                                            <option value="{{ $pd->id }}">{{ $pd->nama_produk }} - Stok: {{ $pd->stock }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="produk[${produkIndex}][JumlahProduk]">Jumlah Produk:</label>
                                    <input type="number" name="produk[${produkIndex}][JumlahProduk]" class="form-control" min="1" max="{{ $produks->stock }}" required>
                                </div>
                                <button type="button" class="btn btn-danger remove-produk">Hapus Produk</button>
                            `;
                            produkContainer.appendChild(newProdukItem);
                            produkIndex++;
                        });

                        document.getElementById('produk-container').addEventListener('click', function (event) {
                            if (event.target.classList.contains('remove-produk')) {
                                event.target.parentElement.remove();
                            }
                        });
                    </script>
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