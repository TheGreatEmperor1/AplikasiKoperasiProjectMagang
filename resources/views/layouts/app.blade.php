<!DOCTYPE html>
<html>
<head>
    <title>Koperasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<header class="bg-white border-b shadow-sm sticky top-0 z-40">
    <div class="px-4 h-16 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center text-white">
                🛒
            </div>
            <div>
                <h1 class="text-xl">Toko Koperasi</h1>
                <p class="text-xs text-gray-500">Sistem Manajemen Toko</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right">
                <div class="text-sm">Admin</div>
                <div class="text-xs text-gray-500">Administrator</div>
            </div>
        </div>
    </div>
</header>

<div class="flex">

<aside class="w-64 bg-white border-r min-h-screen p-4">
    <nav class="space-y-1">
        <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 text-green-600">Dashboard</a>
        <a href="/products" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Kelola Barang</a>
        <a href="/cashier" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Kasir</a>
        <a href="/members" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Anggota</a>
        <a href="/suppliers" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Supplier</a>
        <a href="/installments" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Angsuran</a>
        <a href="/savings-loans" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Simpan Pinjam</a>
        <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Laporan</a>
        <a href="/points" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Point</a>
        <a href="/paylater" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">Paylater</a>
    </nav>
</aside>

<main class="flex-1 p-6">
    @yield('content')
</main>

</div>

</body>
</html>