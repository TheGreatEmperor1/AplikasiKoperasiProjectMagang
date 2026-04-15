@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <h1 class="text-2xl mb-4">Kasir</h1>

    <div class="grid grid-cols-3 gap-6">
        {{-- Kolom kiri: pilih pelanggan & daftar produk --}}
        <div class="col-span-2 space-y-4">

            {{-- Pilih pelanggan --}}
            <div class="bg-white p-4 rounded-xl shadow">
                <label class="block text-sm font-semibold mb-2" for="member_id">Pilih Pelanggan (opsional):</label>
                <select id="member_id" class="border rounded px-3 py-2 w-full">
                    <option value="">-- Umum / Non Anggota --</option>
                    @foreach($members as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Daftar produk --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-4 py-3 border-b">
                    <h2 class="font-semibold">Pilih Barang</h2>
                </div>

                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-right">Harga</th>
                            <th class="p-3 text-right">Stock</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $p->name }}</td>
                                <td class="p-3 text-right">Rp {{ number_format($p->sell_price) }}</td>
                                <td class="p-3 text-right">{{ $p->stock }}</td>
                                <td class="p-3 text-right">
                                    <button type="button"
                                            class="px-3 py-1 bg-green-600 text-white rounded text-sm add-to-cart"
                                            data-id="{{ $p->id }}"
                                            data-name="{{ $p->name }}"
                                            data-price="{{ $p->sell_price }}">
                                        Tambah
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Kolom kanan: keranjang & checkout --}}
        <div class="space-y-4">

            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="font-semibold mb-3">Keranjang</h2>

                <table class="w-full text-sm" id="cartTable">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Barang</th>
                            <th class="p-2 text-right">Qty</th>
                            <th class="p-2 text-right">Subtotal</th>
                            <th class="p-2 text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- diisi via JS --}}
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <span class="font-semibold">Total:</span>
                    <span id="cartTotal" class="font-bold">Rp 0</span>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="font-semibold mb-3">Pembayaran</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm mb-1">Tipe Pembayaran</label>
                        <select id="payment_type" class="border rounded px-3 py-2 w-full">
                            <option value="cash">Tunai</option>
                            <option value="debt">Hutang (piutang anggota)</option>
                        </select>
                    </div>

                    <button id="checkoutBtn"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg">
                        Checkout
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    console.log('Cashier page script loaded');

    const cart = [];
    const formatter = new Intl.NumberFormat('id-ID');

    function renderCart() {
        const tbody = document.querySelector('#cartTable tbody');
        tbody.innerHTML = '';

        let total = 0;

        cart.forEach((item, index) => {
            const tr = document.createElement('tr');
            const subtotal = item.qty * item.price;
            total += subtotal;

            tr.innerHTML = `
                <td class="p-2">${item.name}</td>
                <td class="p-2 text-right">${item.qty}</td>
                <td class="p-2 text-right">Rp ${formatter.format(subtotal)}</td>
                <td class="p-2 text-right">
                    <button type="button" data-index="${index}" class="text-red-600 text-xs remove-item">
                        Hapus
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('cartTotal').innerText = 'Rp ' + formatter.format(total);

        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function () {
                const idx = this.getAttribute('data-index');
                cart.splice(idx, 1);
                renderCart();
            });
        });

        console.log('Cart rendered:', cart);
    }

    // Tambah ke keranjang
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function () {
            const id    = this.dataset.id;
            const name  = this.dataset.name;
            const price = parseInt(this.dataset.price, 10);

            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.qty += 1;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }

            console.log('Item added to cart:', { id, name, price });
            renderCart();
        });
    });

    const checkoutBtn = document.getElementById('checkoutBtn');
    console.log('checkoutBtn element:', checkoutBtn);

    checkoutBtn.addEventListener('click', function () {
        console.log('Checkout button clicked');

        const total = cart.reduce((sum, item) => sum + item.qty * item.price, 0);
        const type  = document.getElementById('payment_type').value;
        const memberId = document.getElementById('member_id').value || null;

        console.log('Checkout data before send:', {
            total, type, memberId, cart
        });

        if (cart.length === 0) {
            alert('Keranjang masih kosong.');
            return;
        }

        fetch('/cashier/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                total: total,
                type: type,
                member_id: memberId,
                items: cart,
            }),
        })
        .then(async (res) => {
            console.log('Status checkout:', res.status);

            if (!res.ok) {
                const text = await res.text();
                console.error('Checkout error response:', text);
                alert('Checkout gagal (' + res.status + '). Buka Console (F12) untuk detail.');
                return null;
            }
            return res.json();
        })
        .then((data) => {
            if (!data) return;

            console.log('Checkout success response:', data);

            if (data.status === 'success') {
                alert('Transaksi berhasil disimpan.');
                cart.length = 0;
                renderCart();
            }
        })
        .catch((err) => {
            console.error('Fetch error:', err);
            alert('Terjadi error saat checkout. Lihat Console (F12).');
        });
    });
</script>

@endsection
