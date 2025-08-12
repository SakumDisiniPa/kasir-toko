@extends('layouts.main', ['title' => 'Pelanggan'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-users mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Daftar Pelanggan</h1>
</div>
@endsection

@section('content')
@if (session('store') == 'success')
    <x-alert type="success" message="<strong>Berhasil dibuat!</strong> Pelanggan berhasil dibuat." />
@endif
@if (session('update') == 'success')
    <x-alert type="success" message="<strong>Berhasil diupdate!</strong> Pelanggan berhasil diupdate." />
@endif
@if (session('destroy') == 'success')
    <x-alert type="success" message="<strong>Berhasil dihapus!</strong> Pelanggan berhasil dihapus." />
@endif

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <a href="{{ route('pelanggan.create') }}" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i>
                Tambah Pelanggan Baru
            </a>
            
            <form action="?" method="get" class="w-full md:w-auto">
                <div class="relative flex items-center">
                    <input type="text" class="w-full pr-12 pl-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-lg transition-all duration-200"
                            name="search" value="<?= request()->search ?>" placeholder="Cari nama pelanggan...">
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Nomor Telepon</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pelanggans as $key => $pelanggan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">{{ $pelanggans->firstItem() + $key }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-user-circle text-blue-500 mr-3 text-2xl"></i>
                                    <span class="text-lg font-medium text-gray-900">{{ $pelanggan->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-green-500 mr-3"></i>
                                    <span>{{ $pelanggan->nomor_tlp }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-yellow-500 mr-3"></i>
                                    <span class="text-lg text-gray-700 truncate" style="max-width: 300px;" title="{{ $pelanggan->alamat }}">
                                        {{ $pelanggan->alamat }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('pelanggan.edit', ['pelanggan' => $pelanggan->id]) }}"
                                        class="p-2 text-green-600 bg-green-100 rounded-full hover:bg-green-200 transition-colors duration-200"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#modalDelete"
                                        data-url="{{ route('pelanggan.destroy', ['pelanggan' => $pelanggan->id]) }}"
                                        class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10">
                                <div class="text-gray-500">
                                    <i class="fas fa-users fa-4x mb-4"></i>
                                    <h5 class="text-xl font-semibold">Belum Ada Pelanggan</h5>
                                    <p class="mt-2">Silakan tambah pelanggan terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="lg:hidden p-4 space-y-4">
            @forelse ($pelanggans as $key => $pelanggan)
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <span class="bg-gray-200 text-gray-700 font-semibold text-sm px-3 py-1 rounded-full mr-3">{{ $pelanggans->firstItem() + $key }}</span>
                            <h6 class="text-lg font-bold text-gray-900">{{ $pelanggan->nama }}</h6>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('pelanggan.edit', ['pelanggan' => $pelanggan->id]) }}"
                                class="p-2 text-green-600 bg-green-100 rounded-full hover:bg-green-200 transition-colors duration-200"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" data-toggle="modal" data-target="#modalDelete"
                                data-url="{{ route('pelanggan.destroy', ['pelanggan' => $pelanggan->id]) }}"
                                class="btn-delete p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 transition-colors duration-200"
                                title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-base text-gray-700 space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-green-500 mr-3"></i>
                            <span>{{ $pelanggan->nomor_tlp }}</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-yellow-500 mr-3 mt-1"></i>
                            <p>{{ $pelanggan->alamat }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-6">
                    <div class="text-gray-500">
                        <i class="fas fa-users fa-4x mb-4"></i>
                        <h5 class="text-xl font-semibold">Belum Ada Pelanggan</h5>
                        <p class="mt-2">Silakan tambah pelanggan terlebih dahulu</p>
                        <a href="{{ route('pelanggan.create') }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-plus mr-3"></i>
                            Tambah Pelanggan Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if($pelanggans->hasPages())
    <div class="p-6 sm:p-8 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="text-sm text-gray-600 hidden md:block">
            Menampilkan <span class="font-bold">{{ $pelanggans->firstItem() }}</span> sampai <span class="font-bold">{{ $pelanggans->lastItem() }}</span> 
            dari <span class="font-bold">{{ $pelanggans->total() }}</span> data
        </div>
        <div class="w-full md:w-auto">
            {{ $pelanggans->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('modals')
    <x-modal-delete />
@endpush