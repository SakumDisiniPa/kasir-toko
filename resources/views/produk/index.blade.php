@extends('layouts.main', ['title' => 'Produk'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-box-open mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Daftar Produk</h1>
</div>
@endsection

@section('content')
@if (session('store') == 'success')
    <x-alert type="success" message="<strong>Berhasil dibuat!</strong> Produk berhasil dibuat." />
@endif
@if (session('update') == 'success')
    <x-alert type="success" message="<strong>Berhasil diupdate!</strong> Produk berhasil diupdate." />
@endif
@if (session('destroy') == 'success')
    <x-alert type="success" message="<strong>Berhasil dihapus!</strong> Produk berhasil dihapus." />
@endif

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <a href="{{ route('produk.create') }}" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i>
                Tambah Produk Baru
            </a>
            
            <form action="?" method="get" class="w-full md:w-auto">
                <div class="relative flex items-center">
                    <input type="text" class="w-full pr-12 pl-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-lg transition-all duration-200"
                            name="search" value="{{ request()->search }}" placeholder="Cari kode atau nama produk...">
                    <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-gray-500 hover:text-orange-500 transition-colors duration-200">
                        <i class="fas fa-search text-xl"></i>
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Kode Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($produks as $key => $produk)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">{{ $produks->firstItem() + $key }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900">{{ $produk->kode_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">{{ $produk->nama_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">{{ $produk->nama_kategori }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-green-600">{{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">{{ $produk->stok }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('produk.edit', ['produk' => $produk->id]) }}"
                                        class="p-2 text-green-600 bg-green-100 rounded-full hover:bg-green-200 transition-colors duration-200"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#modalDelete"
                                        data-url="{{ route('produk.destroy', ['produk' => $produk->id]) }}"
                                        class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10">
                                <div class="text-gray-500">
                                    <i class="fas fa-box-open fa-4x mb-4"></i>
                                    <h5 class="text-xl font-semibold">Belum Ada Produk</h5>
                                    <p class="mt-2">Silakan tambah produk terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="lg:hidden p-4 space-y-4">
            @forelse ($produks as $key => $produk)
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <h6 class="text-lg font-bold text-gray-900">{{ $produk->nama_produk }}</h6>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('produk.edit', ['produk' => $produk->id]) }}"
                                class="p-2 text-green-600 bg-green-100 rounded-full hover:bg-green-200 transition-colors duration-200"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" data-toggle="modal" data-target="#modalDelete"
                                data-url="{{ route('produk.destroy', ['produk' => $produk->id]) }}"
                                class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                                title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-base text-gray-700 space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-barcode text-blue-500 mr-3"></i>
                            <span>{{ $produk->kode_produk }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-layer-group text-purple-500 mr-3"></i>
                            <span>{{ $produk->nama_kategori }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-money-bill-wave text-green-500 mr-3"></i>
                            <span class="font-bold text-lg">{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-cubes text-gray-500 mr-3"></i>
                            <span>Stok: {{ $produk->stok }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-6">
                    <div class="text-gray-500">
                        <i class="fas fa-box-open fa-4x mb-4"></i>
                        <h5 class="text-xl font-semibold">Belum Ada Produk</h5>
                        <p class="mt-2">Silakan tambah produk terlebih dahulu</p>
                        <a href="{{ route('produk.create') }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-plus mr-3"></i>
                            Tambah Produk Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if($produks->hasPages())
    <div class="p-6 sm:p-8 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="text-sm text-gray-600 hidden md:block">
            Menampilkan <span class="font-bold">{{ $produks->firstItem() }}</span> sampai <span class="font-bold">{{ $produks->lastItem() }}</span> 
            dari <span class="font-bold">{{ $produks->total() }}</span> data
        </div>
        <div class="w-full md:w-auto">
            {{ $produks->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('modals')
    <x-modal-delete />
@endpush