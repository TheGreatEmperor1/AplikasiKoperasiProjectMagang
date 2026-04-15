@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <h1 class="text-2xl">Kelola Anggota</h1>

    {{-- Form tambah anggota --}}
    <div class="bg-white p-4 rounded-xl shadow">
        <form action="{{ route('members.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold mb-1">Nama</label>
                <input type="text" name="name" id="name"
                       class="px-3 py-2 border rounded w-64" required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold mb-1">Telepon</label>
                <input type="text" name="phone" id="phone"
                       class="px-3 py-2 border rounded w-48" required>
            </div>

            <div>
                <label for="credit_limit" class="block text-sm font-semibold mb-1">Limit Kredit</label>
                <input type="number" name="credit_limit" id="credit_limit"
                       class="px-3 py-2 border rounded w-40" value="0" min="0" required>
            </div>

            <div>
                <label for="address" class="block text-sm font-semibold mb-1">Alamat (opsional)</label>
                <input type="text" name="address" id="address"
                       class="px-3 py-2 border rounded w-72">
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg">
                Tambah Anggota
            </button>
        </form>
    </div>

    {{-- Tabel daftar anggota + search --}}
    <div class="bg-white p-4 rounded-xl shadow">

        {{-- Baris search --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold">Daftar Anggota</h2>

            <form action="{{ route('members.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari nama anggota..."
                       class="px-3 py-2 border rounded w-64">
                <button type="submit"
                        class="px-3 py-2 bg-gray-200 rounded">
                    Cari
                </button>
            </form>
        </div>

        <table class="w-full">
            <tr class="bg-gray-100">
                <th class="p-3 w-16">Aksi</th>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3">Telepon</th>
                <th class="p-3 text-right">Limit</th>
            </tr>

            @forelse($members as $m)
                <tr class="border-t">
                    <td class="p-3 text-center space-x-2">
                        <button
                            class="text-blue-600 underline text-sm"
                            onclick="openEditModal({{ $m->id }}, '{{ e($m->name) }}', '{{ e($m->phone) }}', '{{ e($m->address) }}', {{ $m->credit_limit }})">
                            Edit
                        </button>
                        <form action="{{ route('members.destroy', $m->id) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Yakin mau hapus anggota ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 underline text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>

                    <td class="p-3">{{ $m->name }}</td>
                    <td class="p-3">{{ $m->phone }}</td>
                    <td class="p-3 text-right">Rp {{ number_format($m->credit_limit) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-3 text-center text-gray-500">
                        Belum ada anggota.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>

</div>

{{-- Modal Edit Anggota --}}
<div id="editModal"
     class="fixed inset-0 bg-black/40 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Anggota</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="edit_name" class="block text-sm font-semibold mb-1">Nama</label>
                <input type="text" name="name" id="edit_name"
                       class="px-3 py-2 border rounded w-full" required>
            </div>

            <div class="mb-3">
                <label for="edit_phone" class="block text-sm font-semibold mb-1">Telepon</label>
                <input type="text" name="phone" id="edit_phone"
                       class="px-3 py-2 border rounded w-full" required>
            </div>

            <div class="mb-3">
                <label for="edit_credit_limit" class="block text-sm font-semibold mb-1">Limit Kredit</label>
                <input type="number" name="credit_limit" id="edit_credit_limit"
                       class="px-3 py-2 border rounded w-full" min="0" required>
            </div>

            <div class="mb-4">
                <label for="edit_address" class="block text-sm font-semibold mb-1">Alamat (opsional)</label>
                <input type="text" name="address" id="edit_address"
                       class="px-3 py-2 border rounded w-full">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 rounded-lg">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, phone, address, limit) {
        const form = document.getElementById('editForm');

        // set action: /members/{id}
        form.action = '/members/' + id;

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address ?? '';
        document.getElementById('edit_credit_limit').value = limit;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@endsection
