<form action="#" class="bg-white rounded-3xl shadow-2xl p-6 mb-6" id="formBarcode">
    <div class="relative flex items-center">
        <input type="text" class="w-full pl-4 pr-24 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
               id="barcode" placeholder="Kode / Barcode">
        <div class="absolute right-0 top-0 bottom-0 flex items-center pr-1">
            <button type="reset" class="px-3 py-1.5 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors duration-200 flex items-center" title="Bersihkan">
                <i class="fas fa-times"></i>
                <span class="d-none d-sm-inline ml-1">Clear</span>
            </button>
        </div>
    </div>
    <div class="text-sm text-red-500 mt-2" id="msgErrorBarcode" style="display: none;"></div>
</form>

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
$(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }});

    let currentKodeProduk = null;

    $('#barcode').focus();

    // Tangani input manual barcode
    $('#formBarcode').submit(e => {
        e.preventDefault();
        const kode = $('#barcode').val().trim();
        if (kode) addItem(kode);
    });

    $('button[type="reset"]').click(() => $('#barcode').val('').focus());

    // Handler tambah produk
    function addItem(kode_produk) {
        if (!kode_produk) return;
        currentKodeProduk = kode_produk;
        $('#qtyInput').val(1);
        $('#qtyModal').modal('show');
    }

    // Auto focus on quantity input when modal opens
    $('#qtyModal').on('shown.bs.modal', function() {
        $('#qtyInput').focus().select();
    });

    // Submit quantity
    $('#qtyForm').submit(function(e) {
        e.preventDefault();
        const qty = parseInt($('#qtyInput').val()) || 1;
        if (!currentKodeProduk || qty < 1) return;

        const submitBtn = $('#qtyForm button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Menambahkan...').prop('disabled', true);

        $('#qtyModal').modal('hide');
        $('#msgErrorBarcode').hide().html('');
        $('#barcode').removeClass('is-invalid').prop('disabled', true);

        $.post("/cart", {
            kode_produk: currentKodeProduk,
            quantity: qty
        }, function(response) {
            fetchCart();
            $('#barcode').val('').prop('disabled', false).focus();
        }, "json").fail(function(error) {
            if (error.status === 422) {
                $('#msgErrorBarcode').show().html(error.responseJSON.errors.kode_produk[0]);
                $('#barcode').addClass('is-invalid');
            }
        }).always(function() {
            currentKodeProduk = null;
            submitBtn.html(originalText).prop('disabled', false);
        });
    });
});
</script>
@endpush