<form action="" method="get" id="formCariPelanggan" class="bg-white rounded-3xl shadow-2xl p-6 mb-6">
    <div class="relative flex items-center">
        <input type="text" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-lg transition-all duration-200" 
               placeholder="Cari pelanggan..." id="searchPelanggan">
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
            <tbody id="resultPelanggan" class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(function() {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});

        $('#formCariPelanggan').submit(function(e) {
            e.preventDefault();
            const search = $('#searchPelanggan').val().trim();
            if (search.length >= 3) {
                fetchCariPelanggan(search);
            } else {
                $('#resultPelanggan').html('<tr><td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td></tr>');
            }
        });
        
        // Real-time search
        $('#searchPelanggan').on('input', function() {
            const search = $(this).val().trim();
            if (search.length >= 3) {
                fetchCariPelanggan(search);
            } else if (search.length === 0) {
                $('#resultPelanggan').html('<tr><td class="px-6 py-4 text-center text-gray-500">Ketik minimal 3 karakter untuk mencari</td></tr>');
            }
        });
    });

    function fetchCariPelanggan(search) {
        $('#resultPelanggan').html('<tr><td class="px-6 py-4 text-center text-gray-500"><i class="fas fa-spinner fa-spin mr-2"></i>Mencari...</td></tr>');
        
        $.getJSON("/transaksi/pelanggan", {
            search: search
        }, function(response) {
            $('#resultPelanggan').html('');
            if (response.length === 0) {
                $('#resultPelanggan').html('<tr><td class="px-6 py-4 text-center text-gray-500">Tidak ada hasil ditemukan</td></tr>');
            } else {
                response.forEach(item => {
                    addResultPelanggan(item);
                });
            }
        }).fail(function() {
            $('#resultPelanggan').html('<tr><td class="px-6 py-4 text-center text-red-500">Terjadi kesalahan saat mencari</td></tr>');
        });
    }

    function addResultPelanggan(item) {
        const { id, nama } = item;

        const btn = `<button type="button" 
                        class="px-3 py-1 bg-green-500 text-white text-xs rounded-full hover:bg-green-600 transition-colors duration-200"
                        onclick="addPelanggan(${id})"
                        title="Pilih pelanggan ${nama}">
                        <i class="fas fa-check"></i>
                    </button>`;

        const row = `<tr class="hover:bg-gray-50 cursor-pointer transition-colors duration-200" onclick="addPelanggan(${id})">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <strong class="text-base text-gray-900">${nama}</strong>
                                    <div class="hidden md:block">
                                        <small class="text-sm text-gray-500">ID: ${id}</small>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    ${btn}
                                </div>
                            </div>
                        </td>
                    </tr>`;
        $('#resultPelanggan').append(row);
    }

    function addPelanggan(id) {
        const targetBtn = $(`button[onclick="addPelanggan(${id})"]`);
        const originalHtml = targetBtn.html();
        
        targetBtn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
        
        $.post("/transaksi/pelanggan", {
            id: id
        }, function(response) {
            fetchCart();
            const pelangganRow = targetBtn.closest('tr');
            pelangganRow.addClass('bg-green-100');
            setTimeout(() => {
                pelangganRow.removeClass('bg-green-100');
                targetBtn.html(originalHtml).prop('disabled', false);
            }, 1000);
        }, "json").fail(function() {
            const pelangganRow = targetBtn.closest('tr');
            pelangganRow.addClass('bg-red-100');
            setTimeout(() => {
                pelangganRow.removeClass('bg-red-100');
                targetBtn.html(originalHtml).prop('disabled', false);
            }, 1000);
        });
    }
</script>
@endpush