<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pembayaran</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            background-color: #f5f5f5;
            margin: 0;
            padding: 10px;
            color: #333;
        }
        .invoice {
            width: 80mm;
            max-width: 100%;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .address {
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 15px 0;
            border: none;
        }
        .transaction-info {
            margin-bottom: 15px;
        }
        .transaction-info p {
            margin: 5px 0;
            font-size: 13px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .product-table tr:not(:last-child) {
            margin-bottom: 8px;
        }
        .product-name {
            padding-right: 10px;
        }
        .product-price {
            text-align: right;
            white-space: nowrap;
        }
        .summary {
            text-align: right;
            margin-top: 15px;
        }
        .summary p {
            margin: 5px 0;
        }
        .total {
            font-weight: 500;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            font-weight: 500;
            font-size: 16px;
        }
        .highlight {
            color: #e74c3c;
            font-weight: 500;
        }
    </style>
</head>
<body onload="javascript:window.print()">
    <div class="invoice">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <div class="address">
                Jl. Raya Padaherang Km.1, Desa Padaherang<br>
                Kec.Padaherang - Kab.Pangandaran
            </div>
        </div>

        <hr class="divider">

        <div class="transaction-info">
            <p><strong>Kode Transaksi:</strong> {{ $penjualan->kode }}</p>
            <p><strong>Tanggal:</strong> {{ date('d/m/Y H:i:s', strtotime($penjualan->tanggal)) }}</p>
            <p><strong>Pelanggan:</strong> {{ $pelanggan->nama }}</p>
            <p><strong>Kasir:</strong> {{ $user->nama }}</p>
        </div>

        <hr class="divider">

        <table class="product-table">
            @foreach ($detilPenjualan as $row)
                <tr>
                    <td class="product-name">{{ $row->jumlah }}x {{ $row->nama_produk }}</td>
                    <td class="product-price">{{ number_format($row->harga_produk, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">{{ number_format($row->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <hr class="divider">

        <div class="summary">
            <p>Sub Total: {{ number_format($penjualan->subtotal, 0, ',', '.') }}</p>
            <p>Pajak PPN(10%): {{ number_format($penjualan->pajak, 0, ',', '.') }}</p>
            <p class="total">Total: {{ number_format($penjualan->total, 0, ',', '.') }}</p>
            <p>Tunai: {{ number_format($penjualan->tunai, 0, ',', '.') }}</p>
            <p class="highlight">Kembalian: {{ number_format($penjualan->kembalian, 0, ',', '.') }}</p>
        </div>

        <div class="footer">Terima Kasih</div>
    </div>
</body>
</html>