@extends('layouts.main', ['title' => 'Tambah Pelanggan'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-users mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Tambah Pelanggan</h1>
</div>
@endsection

@section('content')
<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-5">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-plus-circle text-white text-xl"></i>
                </div>
                <h3 class="ml-3 text-xl font-semibold text-white">Form Pelanggan Baru</h3>
            </div>
        </div>
        
        <form method="POST" action="{{ route('pelanggan.store') }}" class="px-6 py-8 space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    Nama Lengkap <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                    <x-input name="nama" type="text" 
                             class="w-full px-4 py-3 border border-gray-300 rounded-lg transition-all duration-200 focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                             placeholder="Masukkan nama lengkap" />
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                    Alamat <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                    <x-textarea name="alamat" rows="3" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg transition-all duration-200 focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                                placeholder="Masukkan alamat lengkap" />
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700">
                    <i class="fas fa-phone text-yellow-500 mr-2"></i>
                    Nomor Telepon/HP <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                    <x-input name="nomor_tlp" type="text" 
                             class="w-full px-4 py-3 border border-gray-300 rounded-lg transition-all duration-200 focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                             placeholder="Contoh: 08123456789" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('pelanggan.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center hover:shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-lg font-medium text-white hover:from-orange-600 hover:to-amber-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Pelanggan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection