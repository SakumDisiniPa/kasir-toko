@extends('layouts.main', ['title' => 'Produk'])

@section('title-content')
<div class="flex items-center">
    <i class="fas fa-box-open mr-2 text-orange-500"></i>
    <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
</div>
@endsection

@section('content')
<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-5">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-plus-circle text-white text-xl"></i>
                </div>
                <h3 class="ml-3 text-xl font-semibold text-white">Formulir Produk Baru</h3>
            </div>
        </div>
        
        <!-- Form Body -->
        <form method="POST" action="{{ route('produk.store') }}" class="px-6 py-8 space-y-6">
            @csrf
            
            <!-- Kode Produk -->
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-barcode text-blue-500 mr-2"></i>
                    Kode Produk <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                    <x-input name="kode_produk" type="text" 
                             class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200" 
                             placeholder="PRD-001" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-qrcode text-gray-400"></i>
                    </div>
                </div>
            </div>
            
            <!-- Nama Produk -->
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-tag text-green-500 mr-2"></i>
                    Nama Produk <span class="text-red-500 ml-1">*</span>
                </label>
                <x-input name="nama_produk" type="text" 
                         class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200" 
                         placeholder="Nama produk" />
            </div>
            
            <!-- Harga Produk -->
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-money-bill-wave text-yellow-500 mr-2"></i>
                    Harga Produk <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                    <x-input name="harga" type="text" 
                             class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200" 
                             placeholder="0" />
                </div>
                <p class="mt-1 text-xs text-gray-500 flex items-center">
                    <i class="fas fa-info-circle mr-1 text-blue-500"></i>
                    Masukkan harga dalam format Rupiah
                </p>
            </div>
            
            <!-- Kategori -->
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-layer-group text-purple-500 mr-2"></i>
                    Kategori <span class="text-red-500 ml-1">*</span>
                </label>
                <x-select name="kategori_id" :options="$kategoris" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 appearance-none" />
            </div>
            
            <!-- Form Footer -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('produk.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-lg font-medium text-white hover:from-orange-600 hover:to-amber-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom select arrow */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Animation for form elements */
    form > div {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.4s ease-out forwards;
    }
    
    form > div:nth-child(1) { animation-delay: 0.1s; }
    form > div:nth-child(2) { animation-delay: 0.2s; }
    form > div:nth-child(3) { animation-delay: 0.3s; }
    form > div:nth-child(4) { animation-delay: 0.4s; }
    form > div:nth-child(5) { animation-delay: 0.5s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hover effect for buttons */
    button:hover {
        transform: translateY(-2px);
    }
</style>
@endpush