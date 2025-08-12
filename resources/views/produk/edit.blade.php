@extends('layouts.main', ['title' => 'Produk'])

@section('title-content')
    <i class="fas fa-box-open mr-2"></i>
    Produk
@endsection

@section('content')
<div class="flex justify-center py-8 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-full">
        <form method="POST" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden"
              action="{{ route('produk.update', ['produk' => $produk->id]) }}">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-5 bg-gradient-to-r from-orange-400 to-amber-500 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-edit mr-3"></i>
                    Ubah Produk
                </h3>
                <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-yellow-300 rounded-full">
                    Edit Mode
                </span>
            </div>
            
            <div class="p-6 space-y-6">
                <div>
                    <label for="kode_produk" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-barcode text-blue-500 mr-2"></i>
                        Kode Produk <span class="text-red-500">*</span>
                    </label>
                    <x-input name="kode_produk" id="kode_produk" type="text" :value="$produk->kode_produk" class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-lg" />
                </div>
                
                <div>
                    <label for="nama_produk" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-tag text-green-500 mr-2"></i>
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <x-input name="nama_produk" id="nama_produk" type="text" :value="$produk->nama_produk" class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-400 text-lg" />
                </div>
                
                <div>
                    <label for="harga" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-money-bill-wave text-yellow-500 mr-2"></i>
                        Harga Produk <span class="text-red-500">*</span>
                    </label>
                    <x-input name="harga" id="harga" type="text" :value="$produk->harga" class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 text-lg" />
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Masukkan harga dalam format angka, tanpa tanda baca.
                    </p>
                </div>
                
                <div>
                    <label for="kategori_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-layer-group text-purple-500 mr-2"></i>
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <x-select name="kategori_id" id="kategori_id" :options="$kategoris" :value="$produk->kategori_id" class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-lg" />
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('produk.index') }}" class="w-full sm:w-auto px-6 py-3 text-center text-gray-700 font-medium bg-gray-200 hover:bg-gray-300 rounded-lg">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 text-white font-semibold bg-orange-600 hover:bg-orange-700 rounded-lg">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection