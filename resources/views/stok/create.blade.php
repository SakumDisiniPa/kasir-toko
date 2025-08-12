@extends('layouts.main', ['title' => 'Stok'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-pallet mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Tambah Stok Barang</h1>
</div>
@endsection

@section('content')
<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-5">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-plus-circle text-white text-xl"></i>
                </div>
                <h3 class="ml-3 text-xl font-semibold text-white">Formulir Stok Barang</h3>
            </div>
        </div>

        <form method="POST" action="{{ route('stok.store') }}" class="px-6 py-8 space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-box text-blue-500 mr-2"></i>
                    Nama Produk <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative flex items-center">
                    <input type="text" id="namaProduk" name="nama_produk"
                           class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200"
                           placeholder="Pilih produk..." disabled>
                    <button type="button" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-orange-500 hover:text-orange-600 transition-colors duration-200"
                            data-toggle="modal" data-target="#modalCari" title="Cari Produk">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    @error('produk_id')
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                    @enderror
                </div>
                @error('produk_id')
                    <div class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
                <input type="hidden" name="produk_id" id="produkId">
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-sort-numeric-up-alt text-green-500 mr-2"></i>
                    Jumlah <span class="text-red-500 ml-1">*</span>
                </label>
                <x-input name="jumlah" type="number" 
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
                         placeholder="Masukkan jumlah stok" />
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-truck text-purple-500 mr-2"></i>
                    Nama Suplier <span class="text-red-500 ml-1">*</span>
                </label>
                <x-input name="nama_suplier" type="text"
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200"
                         placeholder="Masukkan nama suplier" />
            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('stok.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-xl font-medium text-white hover:from-orange-600 hover:to-amber-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Stok
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('modals')
<div class="modal fade" id="modalCari" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3xl shadow-2xl">
            <div class="modal-header bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-t-3xl">
                <h5 class="modal-title text-xl font-bold flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Cari Produk
                </h5>
                <button type="button" class="close text-white opacity-100 hover:opacity-75 transition-opacity duration-200" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-6">
                <form id="formSearch" action="" method="get" class="mb-4">
                    <div class="relative">
                        <input type="text" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-lg transition-all duration-200"
                               id="search" placeholder="Ketik minimal 3 karakter untuk mencari...">
                        <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-gray-500 hover:text-orange-500 transition-colors duration-200">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="resultProduk" class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-search fa-2x mb-2"></i><br>
                                    Ketik minimal 3 karakter untuk mencari produk
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
    $(function () {
        $('#formSearch').submit(function (e) {
            e.preventDefault();
            let search = $(this).find('#search').val();
            if (search.length >= 3) {
                fetchProduk(search);
            } else {
                $('#resultProduk').html(`
                    <tr>
                        <td colspan="3" class="text-center text-red-500 py-4">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                            Minimal 3 karakter untuk mencari
                        </td>
                    </tr>
                `);
            }
        });

        $('#search').on('keyup', function() {
            let search = $(this).val();
            if (search.length >= 3) {
                fetchProduk(search);
            } else if (search.length === 0) {
                $('#resultProduk').html(`
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">
                            <i class="fas fa-search fa-2x mb-2"></i><br>
                            Ketik minimal 3 karakter untuk mencari produk
                        </td>
                    </tr>
                `);
            }
        });
    });

    function fetchProduk(search) {
        $('#resultProduk').html(`
            <tr>
                <td colspan="3" class="text-center py-4">
                    <i class="fas fa-spinner fa-spin fa-2x mb-2 text-orange-500"></i><br>
                    <span class="text-gray-700">Mencari produk...</span>
                </td>
            </tr>
        `);

        let url = "{{ route('stok.produk') }}?search=" + search;
        $.getJSON(url, function(result) {
            $('#resultProduk').empty();
            if (result.length > 0) {
                result.forEach((produk, index) => {
                    let row = `
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${ index + 1 }</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${produk.nama_produk}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button type="button" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-200"
                                        onclick="addProduk(${produk.id},'${produk.nama_produk}')">
                                    <i class="fas fa-plus mr-1"></i>Pilih
                                </button>
                            </td>
                        </tr>
                    `;
                    $('#resultProduk').append(row);
                });
            } else {
                $('#resultProduk').html(`
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">
                            <i class="fas fa-box-open fa-2x mb-2"></i><br>
                            Tidak ada produk ditemukan
                        </td>
                    </tr>
                `);
            }
        }).fail(function() {
            $('#resultProduk').html(`
                <tr>
                    <td colspan="3" class="text-center text-red-500 py-4">
                        <i class="fas fa-exclamation-circle fa-2x mb-2"></i><br>
                        Gagal memuat data produk
                    </td>
                </tr>
            `);
        });
    }

    function addProduk(id, nama_produk) {
        $('#namaProduk').val(nama_produk);
        $('#produkId').val(id);
        $('#modalCari').modal('hide');
        
        $('#namaProduk').addClass('border-green-500 ring-2 ring-green-500');
        setTimeout(() => {
            $('#namaProduk').removeClass('border-green-500 ring-2 ring-green-500');
        }, 2000);
    }
</script>
@endpush