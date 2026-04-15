@extends('layouts.app')

@section('content')

<div class="space-y-6">
    <h1 class="text-2xl mb-4">Angsuran Kredit Barang (Pay Later)</h1>

    <div class="bg-white p-4 rounded-xl shadow">
        <table class="w-full">
            <tr class="bg-gray-100">
                <th class="p-3">Pelanggan</th>
                <th class="p-3">Nama Barang</th>
                <th class="p-3 text-right">Jumlah</th>
                <th class="p-3 text-right">Harga Barang</th>
                <th class="p-3 text-right">Kredit</th>
                <th class="p-3 text-right">Dibayarkan</th>
            </tr>

            @forelse($items as $item)
                @php
                    $subtotal = $item['qty'] * $item['price'];
                @endphp
                <tr class="border-t">
                    <td class="p-3">{{ $item['customer_name'] }}</td>
                    <td class="p-3">{{ $item['product_name'] }}</td>
                    <td class="p-3 text-right">{{ $item['qty'] }}</td>
                    <td class="p-3 text-right">{{ number_format($item['price']) }}</td>
                    <td class="p-3 text-right kredit-td">{{ number_format($subtotal) }}</td>
                    <td class="p-3 text-right">
                        <input type="text"
                               class="dibayar-input w-24 px-2 py-1 border rounded text-right"
                               value="0" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-500">
                        Belum ada data pay later.
                    </td>
                </tr>
            @endforelse
        </table>

        <div class="flex justify-end mt-4">
            <span class="font-semibold mr-2">Total Bayar:</span>
            <span id="totalBayar" class="font-bold">0</span>
        </div>
    </div>
</div>

{{-- Script update otomatis total bayar & input dengan titik --}}
<script>
function formatNumber(num) {
    let str = num.replace(/[^\d]/g, ''); // Hanya angka
    if(str === '') return '';
    return str.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

document.addEventListener('DOMContentLoaded', function() {
    function updateTotalBayar() {
        let total = 0;
        document.querySelectorAll('.dibayar-input').forEach((input) => {
            let value = input.value.replace(/\./g, '');
            total += Number(value) || 0;

            let kreditTd = input.closest('tr').querySelector('.kredit-td');
            if (!kreditTd) return;

            let kreditAwal = kreditTd.dataset.kredit || kreditTd.innerText.replace(/\./g,'').replace(/,/g,'');
            if (!kreditTd.dataset.kredit) kreditTd.dataset.kredit = kreditAwal;
            let sisa = Math.max((kreditTd.dataset.kredit - value), 0);
            kreditTd.innerText = Number(sisa).toLocaleString('id-ID');
        });
        document.getElementById('totalBayar').innerText = total.toLocaleString('id-ID');
    }

    document.querySelectorAll('.dibayar-input').forEach(input => {
        input.addEventListener('input', function(e) {
            let cursorPos = input.selectionStart;
            let beforeLen = input.value.length;

            input.value = formatNumber(input.value);

            let afterLen = input.value.length;
            input.selectionEnd = input.selectionStart = cursorPos + (afterLen - beforeLen);

            updateTotalBayar();
        });

        input.value = formatNumber(input.value);
    });
    updateTotalBayar();
});
</script>

@endsection
