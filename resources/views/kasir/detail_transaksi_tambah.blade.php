<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <header class="flex items-center justify-between p-4 bg-indigo-600 shadow-md rounded-b-lg">
        <div class="flex items-center">
            <img src="https://via.placeholder.com/50" alt="Logo Shell" class="h-10 w-10 rounded-full border-2 border-white" />
            <nav class="ml-4">
                <a href="{{ route('kasir.transaksi.create') }}" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Point Of Sales</a>
                <a href="/Kasir/transaksishow" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Riwayat Pesanan</a>
            </nav>
        </div>
        <div class="relative group">
            <div class="flex items-center space-x-4 cursor-pointer">
                <div class="w-10 h-10 bg-red-500 rounded-full"></div>
                <span class="text-white text-lg font-medium">{{ auth()->user()->username ?? 'Guest' }}</span>
            </div>
            <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                <form action="{{ route('logout') }}" method="POST" class="p-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 rounded-md">Logout</button>
                </form>
            </div>
        </div>
    </header>

<main class="p-6">
    <div class="flex justify-between gap-4">
        <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg w-full md:w-2/3">
            <h1 class="text-2xl font-bold mb-4">Produk Bengkel Niken Power Steering</h1>
            <div class="mb-6 flex items-center justify-between">
                <input type="text" id="search" class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Produk..." aria-label="Search products">
                <button class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none" onclick="searchProducts()">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                @foreach ($products as $product)
                    <div class="product-item bg-white rounded-lg shadow-lg p-3 transition-transform transform hover:scale-105">
                        @if ($product->gambar_produk)
                            <img src="{{ asset('storage/' . $product->gambar_produk) }}" alt="Gambar Produk" class="w-24 h-24 object-cover mx-auto mb-2">
                        @else
                            <span class="text-muted block text-center mb-4">Tidak ada gambar</span>
                        @endif
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->nama_produk }}</h2>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <button class="mt-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 add-to-order" 
                                data-id="{{ $product->no_produk }}" 
                                data-name="{{ $product->nama_produk }}" 
                                data-price="{{ $product->harga }}"
                                data-stock="{{ $product->stok }}">
                            Add
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-4">
                <button id="prev-btn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md" onclick="changePage(-1)">Sebelumnya</button>
                <button id="next-btn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md" onclick="changePage(1)">Selanjutnya</button>
            </div>
        </div>
        <div class="max-w-3xl mx-auto bg-white mt-12 p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-gray-700 mb-8">Tambah Transaksi</h1>
            <form method="POST" action="{{ route('kasir.detail.tambahDetailProduk') }}" id="transaksi-form">
                @csrf
                <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">

                <div id="selected-products-container" class="mb-4">
                    <!-- Produk yang dipilih akan ditambahkan di sini -->
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <div class="text-lg font-semibold mr-5">
                        Total: Rp <span id="total-harga">0</span>
                    </div>
                    <button type="submit" class="mt-1 px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productItems = Array.from(document.querySelectorAll('.product-item')); // Semua produk awal
        const searchInput = document.getElementById('search');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
    
        let currentPage = 1;
        const itemsPerPage = 6; // Jumlah produk per halaman
        let filteredProducts = [...productItems]; // Produk yang ditampilkan (hasil filter atau semua)
    
        // Fungsi untuk merender produk pada halaman tertentu
        function renderProducts() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = currentPage * itemsPerPage;
    
            // Tampilkan hanya produk pada halaman saat ini
            productItems.forEach(item => {
                item.style.display = 'none'; // Sembunyikan semua produk
            });
    
            filteredProducts.slice(startIndex, endIndex).forEach(item => {
                item.style.display = 'block'; // Tampilkan produk pada halaman saat ini
            });
    
            // Atur tombol pagination
            prevBtn.style.display = currentPage === 1 ? 'none' : 'inline-block';
            nextBtn.style.display = endIndex >= filteredProducts.length ? 'none' : 'inline-block';
        }
    
        // Fungsi untuk mengubah halaman
        function changePage(direction) {
            currentPage += direction;
            renderProducts();
        }
    
        // Fungsi untuk memfilter produk berdasarkan input pencarian
        function searchProducts() {
            const query = searchInput.value.toLowerCase();
    
            // Filter produk berdasarkan query pencarian
            filteredProducts = productItems.filter(item => {
                const productName = item.querySelector('h2').textContent.toLowerCase();
                return productName.includes(query);
            });
    
            // Reset ke halaman pertama setelah pencarian
            currentPage = 1;
            renderProducts();
        }
    
        // Event listener untuk tombol pagination
        prevBtn.addEventListener('click', () => changePage(-1));
        nextBtn.addEventListener('click', () => changePage(1));
    
        // Event listener untuk pencarian
        searchInput.addEventListener('input', searchProducts);
    
        // Inisialisasi tampilan awal
        renderProducts();
    });
    </script>
    
    
    
</body>
</html>

