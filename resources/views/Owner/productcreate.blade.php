<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-800 text-white flex flex-col">
        <div class="py-8 px-6 text-center">
            <h2 class="text-2xl font-bold tracking-wide">NIKEN POWER STEERING</h2>
        </div>
        <nav class="mt-10 flex-grow">
            <a href="/Owner/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
            <a href="/Owner/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productmenu.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            <!-- No Produk -->
            <div>
                <label for="id_produk" class="block text-sm font-medium text-gray-700">Id Produk</label>
                <input type="text" name="id_produk" id="id_produk" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    value="{{ old('id_produk') }}" required>
            </div>

            <!-- Kategori -->
            <div>
                <label for="kode_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="kode_kategori" id="kode_kategori" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->kode_kategori }}" {{ old('kode_kategori') == $category->kode_kategori ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    value="{{ old('nama_produk') }}" required>
            </div>

            <!-- Gambar Produk -->
            <div>
                <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="gambar_produk" id="gambar_produk" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    accept="image/*" required>
            </div>

            <!-- Stok -->
            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stok" id="stok" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    value="{{ old('stok') }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-md w-full">
                Simpan Produk
            </button>
        </form>
    </div>
</body>
</html>
