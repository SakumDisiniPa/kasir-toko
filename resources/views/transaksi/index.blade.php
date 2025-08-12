@extends('layouts.main', ['title' => 'Transaksi'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-cash-register mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Daftar Transaksi</h1>
</div>
@endsection

@section('content')
@if (session('store') == 'success')
    <x-alert type="success" message="<strong>Berhasil dibuat!</strong> Transaksi berhasil dibuat." />
@endif

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <a href="{{ route('transaksi.create') }}" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i>
                Buat Transaksi Baru
            </a>
            
            <form action="?" method="get" class="w-full md:w-auto">
                <div class="relative flex items-center">
                    <input type="text" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-lg transition-all duration-200"
                            name="search" value="<?= request()->search ?>" placeholder="Cari nomor transaksi...">
                    <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-gray-500 hover:text-orange-500 transition-colors duration-200">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="p-0">
        <div class="hidden lg:block">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nomor Transaksi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Kasir</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($penjualans as $key => $penjualan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">{{ $penjualans->firstItem() + $key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900">{{ $penjualan->nomor_transaksi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">{{ $penjualan->nama_pelanggan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">{{ $penjualan->nama_kasir }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-orange-500">Rp{{ number_format($penjualan->total) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = $penjualan->status == 'selesai' 
                                            ? 'bg-green-100 text-green-700' 
                                            : 'bg-red-100 text-red-700';
                                        $statusIcon = $penjualan->status == 'selesai' 
                                            ? 'fas fa-check-circle' 
                                            : 'fas fa-times-circle';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                        <i class="{{ $statusIcon }} mr-1"></i>
                                        {{ ucfirst($penjualan->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">{{ date('d/m/Y H:i', strtotime($penjualan->tanggal)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('transaksi.show', ['transaksi' => $penjualan->id]) }}"
                                       class="p-2 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition-colors duration-200"
                                       title="Lihat Invoice">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-10">
                                    <div class="text-gray-500">
                                        <i class="fas fa-receipt fa-4x mb-4"></i>
                                        <h5 class="text-xl font-semibold">Belum Ada Transaksi</h5>
                                        <p class="mt-2">Silakan buat transaksi baru terlebih dahulu</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:hidden p-4 space-y-4">
            @forelse ($penjualans as $key => $penjualan)
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <span class="bg-gray-200 text-gray-700 font-semibold text-sm px-3 py-1 rounded-full mr-3">{{ $penjualans->firstItem() + $key }}</span>
                            <h6 class="text-lg font-bold text-gray-900">{{ $penjualan->nomor_transaksi }}</h6>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('transaksi.show', ['transaksi' => $penjualan->id]) }}"
                               class="p-2 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition-colors duration-200"
                               title="Lihat Invoice">
                                <i class="fas fa-file-invoice"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-base text-gray-700 space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-user text-orange-500 mr-3"></i>
                            <span class="font-medium">Pelanggan:</span>
                            <span class="ml-2">{{ $penjualan->nama_pelanggan }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-credit-card text-green-500 mr-3"></i>
                            <span class="font-medium">Total:</span>
                            <span class="font-bold text-lg text-orange-500 ml-2">Rp{{ number_format($penjualan->total) }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-500 mr-3"></i>
                            <span class="font-medium">Tanggal:</span>
                            <span class="ml-2">{{ date('d/m/Y H:i', strtotime($penjualan->tanggal)) }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-purple-500 mr-3"></i>
                            <span class="font-medium">Status:</span>
                            @php
                                $statusClass = $penjualan->status == 'selesai' 
                                    ? 'bg-green-100 text-green-700' 
                                    : 'bg-red-100 text-red-700';
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-sm font-semibold {{ $statusClass }} ml-2">
                                {{ ucfirst($penjualan->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-6">
                    <div class="text-gray-500">
                        <i class="fas fa-receipt fa-4x mb-4"></i>
                        <h5 class="text-xl font-semibold">Belum Ada Transaksi</h5>
                        <p class="mt-2">Silakan buat transaksi baru terlebih dahulu</p>
                        <a href="{{ route('transaksi.create') }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-plus mr-3"></i>
                            Buat Transaksi Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if($penjualans->hasPages())
    <div class="p-6 sm:p-8 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="text-sm text-gray-600 hidden md:block">
            Menampilkan <span class="font-bold">{{ $penjualans->firstItem() }}</span> sampai <span class="font-bold">{{ $penjualans->lastItem() }}</span> 
            dari <span class="font-bold">{{ $penjualans->total() }}</span> data
        </div>
        <div class="w-full md:w-auto">
            {{ $penjualans->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection