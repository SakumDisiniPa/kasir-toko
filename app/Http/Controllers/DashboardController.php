<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data untuk setiap model
        $user = User::selectRaw('count(*) as jumlah')->first();
        $pelanggan = Pelanggan::selectRaw('count(*) as jumlah')->first();
        $kategori = Kategori::selectRaw('count(*) as jumlah')->first();
        $produk = Produk::selectRaw('count(*) as jumlah')->first();

        // Mengambil data penjualan berdasarkan bulan dan tahun
        $penjualan = Penjualan::select(
            DB::raw('SUM(total) as jumlah_total'),
            DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') tgl")
        )
        ->whereMonth('tanggal', date('m'))
        ->whereYear('tanggal', date('Y'))
        ->groupBy('tgl')
        ->get();

        // Nama bulan untuk label grafik
        $nama_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Membuat label untuk grafik
        $label = 'Transaksi ' . $nama_bulan[date('m') - 1] . ' ' . date('Y');
        $labels = [];
        $data = [];

        // Menyusun data untuk grafik
        foreach ($penjualan as $row) {
            $labels[] = substr($row->tgl, 0, 2);
            $data[] = $row->jumlah_total;
        }

        // Mengirimkan data ke tampilan
        return view('welcome', [
            'user' => $user,
            'pelanggan' => $pelanggan,
            'kategori' => $kategori,
            'produk' => $produk,
            'cart' => [
                'label' => $label,
                'labels' => json_encode($labels),
                'data' => json_encode($data)
            ]
        ]);
    }
}
