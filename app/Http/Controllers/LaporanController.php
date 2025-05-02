<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.form');
    }

    public function harian(Request $request)
    {
        // Ambil data penjualan berdasarkan tanggal yang dipilih
        $penjualan = Penjualan::join('users', 'users.id', '=', 'penjualans.user_id')
            ->join('pelanggans', 'pelanggans.id', '=', 'penjualans.pelanggan_id')
            ->whereDate('penjualans.tanggal', $request->tanggal)
            ->select('penjualans.*', 'pelanggans.nama as nama_pelanggan', 'users.nama as nama_kasir')
            ->orderBy('penjualans.id')
            ->get();

        // Mengembalikan view dengan data penjualan
        return view('laporan.harian', [
            'penjualan' => $penjualan
        ]);
    }

    public function bulanan(Request $request)
    {
        // Ambil data penjualan berdasarkan bulan dan tahun yang dipilih
        $penjualan = Penjualan::select(
                DB::raw('COUNT(id) as jumlah_transaksi'),
                DB::raw('SUM(total) as jumlah_total'),
                DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tgl")
            )
            ->whereMonth('penjualans.tanggal', $request->bulan)
            ->whereYear('penjualans.tanggal', $request->tahun)
            ->groupBy(DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y')"))
            ->get();

        // Array nama bulan untuk ditampilkan
        $nama_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Menentukan nama bulan berdasarkan input dari user
        $bulan = isset($nama_bulan[$request->bulan - 1]) ? $nama_bulan[$request->bulan - 1] : null;

        // Mengembalikan view dengan data penjualan dan bulan
        return view('laporan.bulanan', [
            'penjualan' => $penjualan,
            'bulan' => $bulan
        ]);
    }
}
