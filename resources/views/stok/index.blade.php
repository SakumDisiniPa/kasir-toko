@extends('layouts.main', ['title' => 'Stok'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-pallet mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Daftar Stok</h1>
</div>
@endsection

@section('content')
@if (session('store') == 'success')
    <x-alert type="success" message="<strong>Berhasil dibuat!</strong> Stok berhasil dibuat." />
@endif
@if (session('destroy') == 'success')
    <x-alert type="success" message="<strong>Berhasil dihapus!</strong> Stok berhasil dihapus." />
@endif

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <a href="{{ route('stok.create') }}" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i>
                Tambah Stok Baru
            </a>
            
            <form action="?" method="get" class="w-full md:w-auto">
                <div class="relative flex items-center">
                    <input type="date" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-lg transition-all duration-200"
                            name="search" value="<?= request()->search ?>" placeholder="Cari berdasarkan tanggal...">
                    <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-gray-500 hover:text-orange-500 transition-colors duration-200">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="p-0">
        <div class="hidden lg:block">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Suplier</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($stoks as $key => $stok)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">{{ $stoks->firstItem() + $key }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-box-open text-orange-500 mr-3 text-xl"></i>
                                    <span class="text-lg font-medium text-gray-900">{{ $stok->nama_produk }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-lg font-semibold">{{ number_format($stok->jumlah) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-truck text-blue-500 mr-3"></i>
                                    <span class="text-lg text-gray-700">{{ $stok->nama_suplier }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($stok->tanggal)->format('d/m/Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button type="button" data-toggle="modal" data-target="#modalDelete"
                                    data-url="{{ route('stok.destroy', ['stok' => $stok->id]) }}"
                                    class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10">
                                <div class="text-gray-500">
                                    <i class="fas fa-box-open fa-4x mb-4"></i>
                                    <h5 class="text-xl font-semibold">Belum Ada Data Stok</h5>
                                    <p class="mt-2">Silakan tambah stok barang terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="lg:hidden p-4 space-y-4">
            @forelse ($stoks as $key => $stok)
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <span class="bg-gray-200 text-gray-700 font-semibold text-sm px-3 py-1 rounded-full mr-3">{{ $stoks->firstItem() + $key }}</span>
                            <h6 class="text-lg font-bold text-gray-900">{{ $stok->nama_produk }}</h6>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#modalDelete"
                            data-url="{{ route('stok.destroy', ['stok' => $stok->id]) }}"
                            class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                            title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="text-base text-gray-700 space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-sort-numeric-up text-green-500 mr-3"></i>
                            <span class="font-medium">Jumlah:</span>
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-sm font-semibold ml-2">{{ number_format($stok->jumlah) }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-truck text-blue-500 mr-3"></i>
                            <span class="font-medium">Suplier:</span>
                            <span class="ml-2">{{ $stok->nama_suplier }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-gray-500 mr-3"></i>
                            <span class="font-medium">Tanggal:</span>
                            <span class="ml-2">{{ \Carbon\Carbon::parse($stok->tanggal)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-6">
                    <div class="text-gray-500">
                        <i class="fas fa-box-open fa-4x mb-4"></i>
                        <h5 class="text-xl font-semibold">Belum Ada Data Stok</h5>
                        <p class="mt-2">Silakan tambah stok barang terlebih dahulu</p>
                        <a href="{{ route('stok.create') }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-plus mr-3"></i>
                            Tambah Stok Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if($stoks->hasPages())
    <div class="p-6 sm:p-8 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="text-sm text-gray-600 hidden md:block">
            Menampilkan <span class="font-bold">{{ $stoks->firstItem() }}</span> sampai <span class="font-bold">{{ $stoks->lastItem() }}</span> 
            dari <span class="font-bold">{{ $stoks->total() }}</span> data
        </div>
        <div class="w-full md:w-auto">
            {{ $stoks->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('modals')
    <x-modal-delete />
@endpush