<form action="" method="get" id="formCariProduk" class="bg-white rounded-3xl shadow-2xl p-6 mb-6">
    <div class="relative flex items-center">
        <input type="text" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
               placeholder="Cari produk..." id="searchProduk">
        <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 flex items-center text-gray-500 hover:text-orange-500 transition-colors duration-200">
            <i class="fas fa-search text-lg"></i>
        </button>
    </div>
</form>

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800">Hasil Pencarian</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody id="resultProduk" class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="qtyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content rounded-3xl shadow-2xl">
            <form id="qtyForm">
                <div class="modal-header bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-t-3xl">
                    <h5 class="modal-title text-xl font-bold">Masukkan Jumlah</h5>
                    <button type="button" class="close text-white opacity-100 hover:opacity-75 transition-opacity duration-200" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body p-6">
                    <div class="space-y-2">
                        <label for="qtyInput" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-center focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
                               id="qtyInput" value="1" min="1" required>
                    </div>
                </div>
                <div class="modal-footer p-4 border-t border-gray-200 flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    <button type="button" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200" data-dismiss="modal">Batal</button>
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-xl font-medium text-white hover:from-orange-600 hover:to-amber-600 transition-all duration-200">
                        <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let selectedKodeProduk = null;
    
    $(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
        
        $('#formCariProduk').submit(function (e) {
            e.preventDefault();
            const search = $('#searchProduk').val().trim();
            if (search.length >= 3) {
                fetchCariProduk(search);
            } else {
                $('#resultProduk').html('<tr><td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td></tr>');
            }
        });
        
        // Real-time search
        $('#searchProduk').on('input', function() {
            const search = $(this).val().trim();
            if (search.length >= 3) {
                fetchCariProduk(search);
            } else if (search.length === 0) {
                $('#resultProduk').html('<tr><td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td></tr>');
            }
        });
        
        // Auto focus on quantity input when modal opens
        $('#qtyModal').on('shown.bs.modal', function() {
            $('#qtyInput').focus().select();
        });
    });

    function fetchCariProduk(search) {
        $('#resultProduk').html('<tr><td class="px-6 py-4 text-center text-gray-500"><i class="fas fa-spinner fa-spin mr-2"></i>Mencari...</td></tr>');
        
        $.getJSON("/transaksi/produk", { search: search }, function (response) {
            $('#resultProduk').html('');
            if (response.length === 0) {
                $('#resultProduk').html('<tr><td class="px-6 py-4 text-center text-gray-500">Tidak ada hasil ditemukan</td></tr>');
            } else {
                response.forEach(item => {
                    addResultProduk(item);
                });
            }
        }).fail(function() {
            $('#resultProduk').html('<tr><td class="px-6 py-4 text-center text-red-500">Terjadi kesalahan saat mencari</td></tr>');
        });
    }

    function addResultProduk(item) {
        const { nama_produk, kode_produk } = item;

        const btn = `<button type="button"
                        class="px-3 py-1 bg-green-500 text-white text-xs rounded-full hover:bg-green-600 transition-colors duration-200"
                        onclick="addItem('${kode_produk}')"
                        title="Tambah ${nama_produk} ke keranjang">
                        <i class="fas fa-plus"></i>
                    </button>`;

        const row = `<tr class="hover:bg-gray-50 cursor-pointer transition-colors duration-200" onclick="addItem('${kode_produk}')">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <strong class="text-base text-gray-900">${nama_produk}</strong>
                                    <div class="hidden md:block">
                                        <small class="text-sm text-gray-500">Kode: ${kode_produk}</small>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    ${btn}
                                </div>
                            </div>
                        </td>
                    </tr>`;
        $('#resultProduk').append(row);
    }

    function addItem(kode_produk) {
        if (!kode_produk) return;

        selectedKodeProduk = kode_produk;
        $('#qtyInput').val(1);
        $('#qtyModal').modal('show');
    }

    $('#qtyForm').submit(function(e) {
        e.preventDefault();
        const qty = parseInt($('#qtyInput').val()) || 1;
        if (!selectedKodeProduk || qty < 1) return;

        const submitBtn = $('#qtyForm button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...').prop('disabled', true);

        $('#qtyModal').modal('hide');
        
        $.post("/cart", {
            kode_produk: selectedKodeProduk,
            quantity: qty
        }, function(response) {
            fetchCart();
            
            const productRow = $(`button[onclick="addItem('${selectedKodeProduk}')"]`).closest('tr');
            productRow.addClass('bg-green-100');
            setTimeout(() => {
                productRow.removeClass('bg-green-100');
            }, 1000);
            
        }, "json").fail(function(error) {
            const productRow = $(`button[onclick="addItem('${selectedKodeProduk}')"]`).closest('tr');
            productRow.addClass('bg-red-100');
            setTimeout(() => {
                productRow.removeClass('bg-red-100');
            }, 1000);
            
        }).always(function() {
            submitBtn.html(originalText).prop('disabled', false);
            selectedKodeProduk = null;
        });
    });
</script>
@endpush