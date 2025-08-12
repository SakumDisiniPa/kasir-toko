<aside class="main-sidebar bg-gradient-to-b from-orange-600 to-orange-500 shadow-xl">
    <!-- Brand Logo -->
    <a href="/" class="brand-link flex items-center justify-center p-4 border-b border-orange-400">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-image h-10 w-10 rounded-full shadow-md border-2 border-white">
        <span class="brand-text ml-3 text-white font-semibold text-lg">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar p-2">
        <nav class="mt-2">
            <ul class="space-y-1">
                <x-nav-item title="Home" icon="fas fa-home" :routes="['home']" />
                <x-nav-item title="Pelanggan" icon="fas fa-users" :routes="['pelanggan.index', 'pelanggan.create', 'pelanggan.edit']"/>
                <x-nav-item title="Produk" icon="fas fa-box-open" :routes="['produk.index', 'produk.create', 'produk.edit']"/>
                <x-nav-item title="Stok" icon="fas fa-pallet" :routes="['stok.index', 'stok.create', 'stok.edit']"/>
                <x-nav-item title="Transaksi" icon="fas fa-cash-register" :routes="['transaksi.index', 'transaksi.create', 'transaksi.show']"/>
                <x-nav-item title="Laporan" icon="fas fa-print" :routes="['laporan.index']"/>
                
                @can('admin')
                <div class="pt-2 mt-2 border-t border-orange-400">
                    <span class="px-4 py-2 text-xs font-semibold text-orange-100 uppercase tracking-wider">Admin Menu</span>
                </div>
                <x-nav-item title="Kategori" icon="fas fa-list" :routes="['kategori.index', 'kategori.create', 'kategori.edit']" />
                <x-nav-item title="Diskon" icon="fas fa-tags" :routes="['diskon.index', 'diskon.create', 'diskon.edit']"/>
                <x-nav-item title="User" icon="fas fa-user-tie" :routes="['user.index', 'user.create', 'user.edit']" />
                @endcan
            </ul>
        </nav>
    </div>
</aside>

@push('styles')
<style>
    /* Custom styles for the nav items */
    .nav-link {
        @apply flex items-center px-4 py-3 text-orange-100 rounded-lg transition-all duration-200;
    }
    
    .nav-link:hover {
        @apply bg-orange-500 text-white shadow-md;
    }
    
    .nav-link.active {
        @apply bg-white text-orange-600 font-medium shadow-lg;
    }
    
    .nav-link.active .nav-icon {
        @apply text-orange-500;
    }
    
    .nav-icon {
        @apply mr-3 text-lg w-6 text-center;
    }
    
    .brand-image {
        transition: transform 0.3s ease;
    }
    
    .brand-link:hover .brand-image {
        transform: scale(1.05);
    }
    
    /* Sidebar animation */
    .main-sidebar {
        transition: all 0.3s ease;
    }
</style>
@endpush