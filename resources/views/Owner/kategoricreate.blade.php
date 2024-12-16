<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Kategori</title>
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
<<<<<<< HEAD
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
=======
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
            <a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="flex-1">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
            <h1 class="text-xl font-semibold">Create Kategori</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('kategori.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="kode_kategori" class="block text-gray-700 font-bold mb-2">Kode Kategori</label>
                    <input 
                        type="text" 
                        name="kode_kategori" 
                        id="kode_kategori" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="nama_kategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

<<<<<<< HEAD
=======
                <div class="mb-4">
                    <label for="jenis" class="block text-gray-700 font-bold mb-2">Jenis</label>
                    <select 
                        name="jenis" 
                        id="jenis" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                        <option value="servis">Servis</option>
                        <option value="barang">Barang</option>
                    </select>
                </div>

>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Create Kategori
                </button>
            </form>
        </div>
    </div>

</body>
</html>
