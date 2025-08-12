<div class="max-w-6xl mx-auto space-y-6">
    <!-- Total Amount Display -->
    <div class="bg-white rounded-3xl shadow-xl p-6 transition-all duration-300 hover:shadow-2xl">
        <div class="text-right">
            <span class="text-sm font-medium text-gray-500">Total Pembayaran</span>
            <div class="text-4xl font-bold text-green-600 tracking-tight">
                Rp <span id="totalJumlah">0</span> ,-
            </div>
        </div>
    </div>

    <!-- Transaction Form -->
    <form action="{{ route('transaksi.store') }}" method="POST" class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        @csrf
        
        <div class="p-6 sm:p-8 space-y-6">
            <!-- Header with Date -->
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Transaksi Baru</h2>
                <p class="text-sm text-gray-500">{{ $tanggal }}</p>
            </div>

            <!-- Customer and Cashier Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                    <div class="relative">
                        <input type="text" id="namaPelanggan"
                               class="w-full px-5 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200 bg-gray-50 @error('pelanggan_id') border-red-500 @enderror"
                               disabled>
                        <input type="hidden" name="pelanggan_id" id="pelangganId">
                    </div>
                    @error('pelanggan_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kasir</label>
                    <input type="text" 
                           class="w-full px-5 py-3 border border-gray-200 rounded-xl bg-gray-50 text-lg cursor-not-allowed"
                           value="{{ $nama_kasir }}" disabled>
                </div>
            </div>

            <!-- Cart Items Table -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Harga</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="resultCart" class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-6">Keranjang belanja kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Discount Section -->
            <div class="flex justify-end">
                <div class="w-full lg:w-1/2 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Kode Diskon</label>
                    <div class="relative flex items-center">
                        <input type="text" id="kodeDiskon" 
                               class="w-full pl-5 pr-12 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
                               placeholder="Masukkan kode diskon">
                        <button type="button" 
                                class="absolute right-3 p-2 text-orange-500 hover:text-orange-600 transition-colors duration-200"
                                onclick="terapkanDiskon()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                    <div id="diskonError" class="text-red-500 text-sm hidden"></div>
                    <div id="diskonSuccess" class="text-green-500 text-sm hidden"></div>
                </div>
            </div>
            
            <!-- Payment Summary -->
            <div class="flex justify-end">
                <div class="w-full lg:w-1/2 space-y-4">
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-600">Subtotal</span>
                            <span class="text-lg font-medium text-gray-800" id="subtotal">Rp 0</span>
                        </div>
                        
                        <div class="flex justify-between items-center hidden" id="diskonRow">
                            <span class="text-sm font-semibold text-gray-600">Diskon</span>
                            <span class="text-lg font-medium text-green-600" id="diskonAmount">- Rp 0</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-600">Pajak 10%</span>
                            <span class="text-lg font-medium text-gray-800" id="taxAmount">Rp 0</span>
                        </div>
                        
                        <hr class="border-gray-300">
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-800">Total Bayar</span>
                            <span class="text-2xl font-extrabold text-orange-500" id="total">Rp 0</span>
                        </div>
                        
                        <div class="pt-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Cash</label>
                            <input type="text" name="cash" 
                                   class="w-full px-5 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200 @error('cash') border-red-500 @enderror" 
                                   placeholder="Jumlah Cash" 
                                   value="{{ old('cash') }}">
                            <input type="hidden" name="total_bayar" id="totalBayar">
                            @error('cash')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex flex-col-reverse sm:flex-row justify-between gap-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('transaksi.index') }}" 
                           class="px-6 py-3 border border-gray-200 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <a href="{{ route('cart.clear') }}" 
                           class="px-6 py-3 border border-red-200 bg-red-50 text-red-600 rounded-xl font-medium hover:bg-red-100 transition-all duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Kosongkan
                        </a>
                    </div>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-xl font-medium text-white hover:from-orange-600 hover:to-amber-600 transition-all duration-200 shadow hover:shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Proses Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(function() {
        fetchCart();
    });
    
    function fetchCart() {
        $.getJSON("/cart", function(response) {
            $('#resultCart').empty();

            const {
                items,
                subtotal,
                tax_amount,
                total,
                extra_info,
                discount_amount
            } = response;

            $('#subtotal').html(rupiah(subtotal));
            $('#taxAmount').html(rupiah(tax_amount));
            $('#total, #totalJumlah').html(rupiah(total));
            $('#totalBayar').val(total);

            if (discount_amount > 0) {
                $('#diskonRow').show();
                $('#diskonAmount').html('- ' + rupiah(discount_amount));
            } else {
                $('#diskonRow').hide();
            }

            if (!items || Object.keys(items).length === 0) {
                $('#resultCart').html(`<tr><td colspan="5" class="text-center text-gray-500 py-6">Keranjang belanja kosong</td></tr>`);
            } else {
                for (const property in items) {
                    addRow(items[property]);
                }
            }

            if (extra_info && extra_info.pelanggan) {
                const { id, nama } = extra_info.pelanggan;
                $('#namaPelanggan').val(nama);
                $('#pelangganId').val(id);
            }
        });
    }
    
    function addRow(item) {
        const {
            hash,
            title,
            quantity,
            price,
            total_price
        } = item;

        const btn = `
            <div class="flex justify-center space-x-2">
                <button type="button" onclick="ePut('${hash}',1)" 
                        class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors duration-200"
                        title="Tambah">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
                <button type="button" onclick="ePut('${hash}',-1)" 
                        class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors duration-200"
                        title="Kurangi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <button type="button" onclick="eDel('${hash}')" 
                        class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors duration-200"
                        title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>`;

        const row = `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${title}</div>
                    <div class="sm:hidden text-xs text-gray-500">${rupiah(price)} × ${quantity}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">${quantity}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 hidden sm:table-cell">${rupiah(price)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">${rupiah(total_price)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center">${btn}</td>
            </tr>`;

        $('#resultCart').append(row);
    }

    function rupiah(number) {
        return 'Rp ' + new Intl.NumberFormat("id-ID").format(number);
    }

    function ePut(hash, qty) {
        $.ajax({
            type: "PUT",
            url: "/cart/" + hash,
            data: { qty: qty },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                fetchCart();
            }
        });
    }

    function eDel(hash) {
        $.ajax({
            type: "DELETE",
            url: "/cart/" + hash,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                fetchCart();
            }
        });
    }
    
    function terapkanDiskon() {
        const kodeDiskon = $('#kodeDiskon').val();
        
        if (!kodeDiskon) {
            showDiskonError('Masukkan kode diskon');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/terapkan-diskon",
            data: { 
                kode_diskon: kodeDiskon
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showDiskonSuccess(response.message);
                    fetchCart();
                } else {
                    showDiskonError(response.message);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                showDiskonError(response.message || 'Terjadi kesalahan');
            }
        });
    }

    function showDiskonError(message) {
        $('#diskonError').text(message).removeClass('hidden');
        $('#diskonSuccess').addClass('hidden');
    }

    function showDiskonSuccess(message) {
        $('#diskonSuccess').text(message).removeClass('hidden');
        $('#diskonError').addClass('hidden');
    }
</script>
@endpush