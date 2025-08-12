@extends('layouts.main', ['title' => 'Home'])

@section('title-content')
<div class="flex items-center">
    <i class="fas fa-home mr-2 text-orange-500"></i>
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
</div>
@endsection

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- Admin Stats Section -->
    @can('admin')
    <div class="mb-8 space-y-4">
        <div class="flex items-center">
            <div class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-shield-alt mr-2"></i>
                <span class="text-sm font-semibold">Admin Panel</span>
            </div>
            <div class="ml-4 h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- User Card -->
            <a href="{{ route('user.index') }}" class="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Users</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $user->jumlah }}</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-lg">
                                <i class="fas fa-user-tie text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Kategori Card -->
            <a href="{{ route('kategori.index') }}" class="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-amber-500">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kategori</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $kategori->jumlah }}</p>
                            </div>
                            <div class="bg-amber-100 p-3 rounded-lg">
                                <i class="fas fa-list text-amber-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Diskon Card -->
            <a href="{{ route('diskon.index') }}" class="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-emerald-500">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Diskon Aktif</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $diskon->jumlah }}</p>
                            </div>
                            <div class="bg-emerald-100 p-3 rounded-lg">
                                <i class="fas fa-tags text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endcan

    <!-- Main Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Pelanggan Card -->
        <a href="{{ route('pelanggan.index') }}" class="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-blue-500">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pelanggan</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $pelanggan->jumlah }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-users text-blue-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Produk Card -->
        <a href="{{ route('produk.index') }}" class="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-cyan-500">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Produk Tersedia</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $produk->jumlah }}</p>
                        </div>
                        <div class="bg-cyan-100 p-3 rounded-lg">
                            <i class="fas fa-box-open text-cyan-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="bg-orange-100 p-2 rounded-lg mr-4">
                    <i class="fas fa-chart-line text-orange-500"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Analytics Overview</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="h-96">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Configuration
        const ctx = document.getElementById('myChart').getContext('2d');
        
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $cart['labels'] !!},
                datasets: [{
                    label: "{{ $cart['label'] }}",
                    data: {!! $cart['data'] !!},
                    borderWidth: 3,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#374151',
                            font: {
                                size: 14,
                                family: "'Source Sans Pro', sans-serif",
                                weight: 600
                            },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: {
                            size: 14,
                            family: "'Source Sans Pro', sans-serif",
                            weight: 'normal'
                        },
                        bodyFont: {
                            size: 14,
                            family: "'Source Sans Pro', sans-serif"
                        },
                        padding: 12,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                family: "'Source Sans Pro', sans-serif",
                                size: 12
                            },
                            callback: function(value) {
                                return value.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                });
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                family: "'Source Sans Pro', sans-serif",
                                size: 12
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'easeOutQuart',
                        from: 0.5,
                        to: 0.3,
                        loop: false
                    }
                }
            }
        });

        // Add animation to cards
        const cards = document.querySelectorAll('a[href]');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s forwards`;
        });

        // Add animation to chart
        const chartContainer = document.getElementById('myChart').parentElement;
        chartContainer.style.opacity = '0';
        chartContainer.style.transform = 'translateY(20px)';
        chartContainer.style.animation = 'fadeInUp 0.5s ease-out 0.3s forwards';
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush