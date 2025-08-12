@extends('layouts.main', ['title' => 'Transaksi'])

@section('title-content')
<div class="flex items-center space-x-3">
    <div class="p-3 bg-orange-100 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-800">Transaksi Baru</h1>
</div>
@endsection

@section('content')
@if ($errors->has('stok'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <strong class="font-medium text-red-700">Stok tidak mencukupi:</strong>
            <span class="ml-2 text-red-600">{{ $errors->first('stok') }}</span>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column (1/3 width) -->
    <div class="space-y-6">
        @include('transaksi.form-code')
        
        <!-- Search Tabs -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="border-b border-gray-200">
                <div class="flex" role="tablist">
                    <button class="flex-1 py-4 px-4 text-center font-medium text-sm lg:text-base transition-colors duration-200 border-r border-gray-200 focus:outline-none"
                            id="cari-produk-tab" 
                            data-toggle="pill" 
                            href="#cari-produk" 
                            role="tab"
                            aria-selected="true">
                        <div class="flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="hidden lg:inline">Cari Produk</span>
                            <span class="lg:hidden">Produk</span>
                        </div>
                    </button>
                    <button class="flex-1 py-4 px-4 text-center font-medium text-sm lg:text-base transition-colors duration-200 focus:outline-none"
                            id="cari-pelanggan-tab" 
                            data-toggle="pill" 
                            href="#cari-pelanggan" 
                            role="tab"
                            aria-selected="false">
                        <div class="flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="hidden lg:inline">Cari Pelanggan</span>
                            <span class="lg:hidden">Customer</span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="p-5">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="cari-produk" role="tabpanel">
                        @include('transaksi.cari-produk')
                    </div>
                    <div class="tab-pane fade" id="cari-pelanggan" role="tabpanel">
                        @include('transaksi.cari-pelanggan')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Column (2/3 width) -->
    <div class="lg:col-span-2">
        @include('transaksi.form-cart')
    </div>
</div>
@endsection