<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Halaman Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<header class="flex items-center justify-between p-4 bg-indigo-500 shadow-md">
    <div class="flex items-center">
        <img src="https://via.placeholder.com/50" alt="Logo Shell" class="h-10 w-10"/>
        <nav class="ml-4">
            <a href="{{ route('kasir.pos') }}" class="text-lg font-semibold text-white mx-2">Point Of Sales</a>
            <a href="{{ route('kasir.transaksi.history') }}" class="text-lg font-semibold text-white mx-2">Riwayat Pesanan</a>
        </nav>
    </div>
    <div class="relative group">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4 cursor-pointer">
            <!-- Profile Picture -->
            <div class="w-10 h-10 bg-red-500 rounded-full"></div>
            
            <!-- Dynamic Username -->
            <span class="text-white text-lg font-medium">
                {{ auth()->user()->username ?? 'Guest' }}
            </span>
        </div>
    
        <!-- Dropdown Menu -->
        <div 
            class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg 
                   shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                   transition-all duration-300 ease-in-out"
        >
            <form action="{{ route('logout') }}" method="POST" class="p-2">
                @csrf
                <button 
                    type="submit" 
                    class="w-full text-left px-4 py-2 text-red-500 
                           hover:bg-gray-100 rounded-md"
                >
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
<main class="p-4">
    <div class="flex justify-between gap-4">
        <!-- Bagian Kategori dan Produk -->
        <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg w-2/3">
            <h1 class="text-2xl font-bold mb-4">Kategori dan Produk</h1>
            
            <!-- Daftar Kategori -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                @foreach($categories as $kategori)
                    @if($kategori->jenis == 'barang' || $kategori->jenis == 'servis')
                        <div class="border border-gray-300 bg-gray-50 p-4 rounded-lg hover:bg-gray-100 shadow-md cursor-pointer" 
                             onclick="window.location.href='{{ route('kategori.show', $kategori->kode_kategori) }}'">
                            <h2 class="text-lg font-bold text-gray-800">{{ ucfirst($kategori->jenis) }}</h2>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Daftar Produk -->
            @isset($kategori)
                <div class="grid grid-cols-3 gap-4">
                    @forelse($produk as $item)
                        <div class="border p-4 rounded-lg shadow-md bg-gray-50 product-item" 
                             data-id="{{ $item->id }}" 
                             data-name="{{ $item->nama_produk }}">
                             
                            <!-- Gambar Produk -->
                            @if ($item->gambar_produk)
                                <img src="{{ $item->gambar_produk }}" alt="{{ $item->nama_produk }}" 
                                     class="w-full h-48 object-cover mb-2 rounded-lg">
                            @else
                                <div class="w-full h-48 flex items-center justify-center border border-gray-300 bg-gray-100 rounded-lg mb-2">Tidak ada gambar</div>
                            @endif

                            <!-- Nama Produk -->
                            <h3 class="text-lg font-bold text-gray-800">{{ $item->nama_produk }}</h3>

                            <!-- Input Harga -->
                            <input type="number" class="input-price border border-gray-300 rounded-lg p-1 w-full mt-2" 
                                   placeholder="Masukkan harga" 
                                   value="{{ $item->harga }}" 
                                   step="100" 
                                   data-default-price="{{ $item->harga }}">
                            
                            <!-- Tombol Tambah ke Pesanan -->
                            <button class="mt-2 bg-indigo-500 text-white font-semibold py-1 px-4 rounded-lg add-to-order">
                                Tambah
                            </button>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-500">Tidak ada produk di kategori ini.</p>
                    @endforelse
                </div>
            @endisset
        </div>

        <!-- Formulir Pesanan -->
        <div class="w-1/3 pl-1 pr-3">
            <form action="{{ route('kasir.transaksi.store') }}" method="POST" class="bg-white p-4 rounded-lg shadow-md w-full">
                @csrf

                <!-- Input ID Transaksi -->
                <div class="mb-4">
                    <label for="id_transaksi" class="block text-lg font-semibold">ID Transaksi</label>
                    <input type="text" id="id_transaksi" name="id_transaksi" 
                           class="border-2 border-indigo-500 rounded-lg p-2 w-full" readonly/>
                </div>

                <!-- Input Tanggal Transaksi -->
                <div class="mb-4">
                    <label for="tanggal_transaksi" class="block text-lg font-semibold">Tanggal Transaksi</label>
                    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" 
                           class="border-2 border-indigo-500 rounded-lg p-2 w-full" required/>
                </div>

                <!-- Input Nama Pelanggan -->
                <div class="mb-4">
                    <label for="nama_pelanggan" class="block text-lg font-semibold">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" 
                           class="border-2 border-indigo-500 rounded-lg p-2 w-full" required/>
                </div>

                <!-- Input Plat Nomor -->
                <div class="mb-4">
                    <label for="plat_nomor" class="block text-lg font-semibold">Plat Nomor</label>
                    <input type="text" id="plat_nomor" name="plat_nomor" 
                           class="border-2 border-indigo-500 rounded-lg p-2 w-full" required/>
                </div>

                <!-- Input Total Harga -->
                <div class="mb-4">
                    <label for="total_harga" class="block text-lg font-semibold">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" 
                           class="border-2 border-indigo-500 rounded-lg p-2 w-full" readonly/>
                </div>

                <!-- Daftar Produk Terpilih -->
                <div id="product-list" class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Produk yang Dipilih:</h3>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-between">
                    <button type="reset" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg">Bersihkan</button>
                    <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg">Pesan</button>
                </div>
            </form>            
        </div>
    </div>
</main>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order');
    const productListContainer = document.getElementById('product-list');
    const totalHargaInput = document.getElementById('total_harga');
    let selectedProducts = [];

    // Tambahkan produk ke daftar pesanan
    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productItem = this.closest('.product-item');
            const productId = productItem.dataset.id;
            const productName = productItem.dataset.name;
            const productPrice = parseFloat(productItem.querySelector('.input-price').value || 0);
            const existingProduct = selectedProducts.find(product => product.id === productId);

            if (existingProduct) {
                alert('Produk sudah ditambahkan.');
                return;
            }

            selectedProducts.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1,
            });

            renderSelectedProducts();
        });
    });

    // Render daftar produk yang dipilih
    function renderSelectedProducts() {
        productListContainer.innerHTML = '';

        selectedProducts.forEach((product, index) => {
            const productElement = document.createElement('div');
            productElement.classList.add('flex', 'justify-between', 'items-center', 'mb-2');

            productElement.innerHTML = `
                <span class="text-gray-700">${product.name}</span>
                <input type="number" class="border border-gray-300 rounded p-1 w-16 quantity-input" 
                       data-index="${index}" 
                       value="${product.quantity}" 
                       min="1" />
                <span class="text-gray-700">x ${product.price.toLocaleString()}</span>
                <button class="bg-red-500 text-white px-2 rounded remove-product" data-index="${index}">Hapus</button>
            `;

            productListContainer.appendChild(productElement);
        });

        updateTotal();
    }

    // Perbarui total harga
    function updateTotal() {
        const total = selectedProducts.reduce((sum, product) => sum + (product.price * product.quantity), 0);
        totalHargaInput.value = total.toLocaleString();
    }

    // Hapus produk dari daftar
    productListContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            const index = e.target.dataset.index;
            selectedProducts.splice(index, 1);
            renderSelectedProducts();
        }
    });

    // Ubah jumlah produk
    productListContainer.addEventListener('input', function (e) {
        if (e.target.classList.contains('quantity-input')) {
            const index = e.target.dataset.index;
            const newQuantity = parseFloat(e.target.value || 1);

            if (newQuantity < 1) {
                alert('Jumlah minimal adalah 1.');
                e.target.value = 1;
                return;
            }

            selectedProducts[index].quantity = newQuantity;
            updateTotal();
        }
    });

    // Pastikan data terkirim ke backend
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'products';
        hiddenInput.value = JSON.stringify(selectedProducts);

        form.appendChild(hiddenInput);
        form.submit();
    });
});

</script>
</body>
</html>
