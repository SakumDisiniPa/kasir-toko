@extends('layouts.main', ['title' => 'Invoice'])

@section('title-content')
<div class="flex items-center text-gray-800">
    <i class="fas fa-file-invoice mr-3 text-orange-500 text-3xl"></i>
    <h1 class="text-3xl font-extrabold">Invoice Penjualan</h1>
</div>
@endsection

@section('content')
    @if (session('destroy') == 'success')
        <x-alert type="success" message="<strong>Berhasil dibatalkan!</strong> Transaksi berhasil dibatalkan." />
    @endif

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-8">
        <div class="flex flex-col md:flex-row justify-between mb-6">
            <div class="mb-4 md:mb-0 text-gray-700">
                <p class="mb-1 text-sm"><strong class="font-semibold">No. Transaksi:</strong> {{ $penjualan->nomor_transaksi }}</p>
                <p class="mb-1 text-sm"><strong class="font-semibold">Nama Pelanggan:</strong> {{ $pelanggan->nama }}</p>
                <p class="mb-1 text-sm hidden sm:block"><strong class="font-semibold">No. Telepon:</strong> {{ $pelanggan->nomor_tlp }}</p>
                <p class="mb-0 text-sm hidden md:block"><strong class="font-semibold">Alamat:</strong> {{ $pelanggan->alamat }}</p>
            </div>
            <div class="text-gray-700 md:text-right">
                <p class="mb-1 text-sm"><strong class="font-semibold">Tgl. Transaksi:</strong> {{ date('d/m/Y H:i:s', strtotime($penjualan->tanggal)) }}</p>
                <p class="mb-1 text-sm"><strong class="font-semibold">Kasir:</strong> {{ $user->nama }}</p>
                <p class="mb-0 text-sm">
                    <strong class="font-semibold">Status:</strong>
                    @if ($penjualan->status == 'selesai')
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                    @endif
                    @if ($penjualan->status == 'batal')
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200 mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Harga</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($detilPenjualan as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $item->nama_produk }}</div>
                                <small class="text-xs text-gray-500 sm:hidden">
                                    {{ number_format($item->harga_produk, 0, ',', '.') }} x {{ $item->jumlah }}
                                </small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-700">{{ $item->jumlah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 hidden sm:table-cell">{{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <div class="w-full md:w-1/2">
                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                    <div class="flex justify-between items-center mb-1 text-sm">
                        <div class="font-semibold text-gray-600">Sub Total:</div>
                        <div class="font-medium text-gray-800">{{ number_format($penjualan->subtotal, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between items-center mb-1 text-sm">
                        <div class="font-semibold text-gray-600">Pajak 10%:</div>
                        <div class="font-medium text-gray-800">{{ number_format($penjualan->pajak, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between items-center mb-1 text-sm">
                        <div class="font-semibold text-gray-600">Diskon:</div>
                        <div class="font-medium text-green-600">- {{ number_format($penjualan->nilai_diskon, 0, ',', '.') }}</div>
                    </div>
                    <hr class="my-3 border-gray-300">
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-xl font-bold text-gray-800">Total:</div>
                        <div class="text-2xl font-extrabold text-orange-500">{{ number_format($penjualan->total, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between items-center mb-1 text-sm">
                        <div class="font-semibold text-gray-600">Cash:</div>
                        <div class="font-medium text-gray-800">{{ number_format($penjualan->tunai, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <div class="font-semibold text-gray-600">Kembalian:</div>
                        <div class="font-medium text-gray-800">{{ number_format($penjualan->kembalian, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 pt-6 border-t border-gray-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('transaksi.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Ke Transaksi
                </a>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                @if ($penjualan->status == 'selesai')
                    <button type="button" class="px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-colors duration-200 w-full sm:w-auto" data-toggle="modal" data-target="#modalBatal">
                        <i class="fas fa-times mr-2"></i>Batalkan Transaksi
                    </button>
                @endif
                <a target="_blank" href="{{ route('transaksi.cetak', ['transaksi' => $penjualan->id]) }}"
                    class="px-6 py-3 bg-blue-500 text-white rounded-xl font-medium hover:bg-blue-600 transition-colors duration-200 w-full sm:w-auto">
                    <i class="fas fa-print mr-2"></i>Cetak Invoice
                </a>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="modalBatal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content rounded-3xl shadow-2xl">
                <div class="modal-header bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-t-3xl">
                    <h5 class="modal-title text-xl font-bold">Batalkan Transaksi</h5>
                    <button type="button" class="close text-white opacity-100 hover:opacity-75 transition-opacity duration-200" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body p-6 text-center">
                    <p class="text-gray-700 text-base mb-4">Apakah Anda yakin ingin membatalkan transaksi ini?</p>
                    <form action="{{ route('transaksi.destroy', ['transaksi' => $penjualan->id]) }}"
                        method="post" style="display: none;" id="formBatal">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <div class="modal-footer p-4 border-t border-gray-200 flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    <button type="button" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200" data-dismiss="modal">Tutup</button>
                    <button type="button" class="w-full sm:w-auto px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-all duration-200" id="yesBatal">Ya, Batalkan!</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $(function(){
            $('#yesBatal').click(function(){
                $('#formBatal').submit();
            });
        })
    </script>
@endpush