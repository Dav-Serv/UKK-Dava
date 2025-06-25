

@extends('layout.main')
@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .kwitansi-container {
            border: 1px solid #000;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
    
    <div class="content-wrapper">
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kwitansi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('penjualan.show', $penjualan->id) }}">detail</a></li>
                <li class="breadcrumb-item active">Kwitansi</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
    <div class="kwitansi-container">
        <div class="header">
            <h1>Kwitansi Penjualan</h1>
            <p>No. Kwitansi: {{ $penjualan->id }}</p>
            <p>Tanggal: {{ \Carbon\Carbon::parse($penjualan->tanggal_jual)->format('D d-m-Y, H:i:s') }}</p>
        </div>
        <div class="info">
            <p>Nama Pelanggan: {{ $penjualan->pelanggan->nama_pelanggan }}</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detailPenjualan as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->jumlah_produk }}</td>
                        <td>{{ "Rp. ".number_format($detail->produk->harga) }}</td>
                        <td>{{ "Rp. ".number_format($detail->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total Harga: {{ "Rp. ".number_format($penjualan->total_harga) }}</strong></p>
        </div>
    </div>
    </div>
@endsection

