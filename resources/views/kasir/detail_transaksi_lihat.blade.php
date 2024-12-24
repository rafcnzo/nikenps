<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<header class="flex items-center justify-between p-4 bg-indigo-600 shadow-md rounded-b-lg">
    <div class="flex items-center">
        <img src="{{ asset('logo.jpg') }}" alt="Logo Bengkel" class="h-10 w-10 rounded-full border-2 border-white" />
        <nav class="ml-4">
            <a href="{{ route('kasir.transaksi.create') }}" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Point Of Sales</a>
            <a href="/Kasir/transaksishow" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Riwayat Pesanan</a>
        </nav>
    </div>
    <div class="relative flex items-center space-x-6"> <!-- Mengubah space-x-4 menjadi space-x-6 untuk memberi jarak lebih -->
        <div class="group">
            <div class="text-white relative cursor-pointer">
                <span class="relative">
                    <span class="text-lg ml-6 pl-6">🔔</span>
                    @if ($lowStockProducts->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full"> <!-- Mengurangi padding untuk membuat lonceng lebih terlihat -->
                            {{ $lowStockProducts->count() }}
                        </span>
                    @endif
                </span>
            </div>
            <div class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                @if ($lowStockProducts->count() > 0)
                    <ul class="p-2">
                        @foreach ($lowStockProducts as $product)
                            <li class="py-2 px-4 border-b border-gray-200 hover:bg-gray-100">
                                {{ $product->nama_produk }}: 
                                <span class="text-red-500 font-semibold">{{ $product->stok }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="p-4 text-gray-500 text-sm">Semua stok aman.</p>
                @endif
            </div>
        </div>
        <div class="relative group">
            <div class="flex items-center cursor-pointer">
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
    </div>
</header>

    <!-- Content -->
    <div class="p-8">
        <!-- Page Title -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Detail Transaksi</h2>
            <a href="/Kasir/transaksishow" 
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Kembali
             </a>
        </div>

        <!-- Detail Transaksi Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('kasir.transaksi.update', $transaksi->id_transaksi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Transaksi ID -->
                    <div class="flex items-center space-x-4">
                        <label for="transaksi_id" class="w-1/3 text-sm font-medium text-gray-700">Transaksi ID</label>
                        <input type="text" id="transaksi_id" value="{{ $transaksi->id_transaksi }}" readonly
                            class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="flex items-center space-x-4">
                        <label for="tanggal_transaksi" class="w-1/3 text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="text" id="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" readonly
                            class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="flex items-center space-x-4">
                        <label for="nama_pelanggan" class="w-1/3 text-sm font-medium text-gray-700">Pelanggan</label>
                        <input type="text" id="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" readonly
                            class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="flex items-center space-x-4">
                        <label for="keterangan_service" class="w-1/3 text-sm font-medium text-gray-700">Deskripsi Service</label>
                        <input type="text" id="keterangan_service" value="{{ $transaksi->Keterangan_Service ?? 'Tidak ada deskripsi' }}" readonly class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">

                    </div>

                    <!-- Service -->
                    <div class="flex items-center space-x-4">
                        <label for="service" class="w-1/3 text-sm font-medium text-gray-700">Servis</label>
                        <input type="text" id="service" value="Rp {{ number_format($transaksi->servis, 0, ',', '.') }}" readonly
                            class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>

                    <!-- Total Harga -->
                    <div class="flex items-center space-x-4">
                        <label for="total_harga" class="w-1/3 text-sm font-medium text-gray-700">Total Harga</label>
                        <input type="text" id="total_harga" value="Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}" readonly
                            class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>
                </div>
            </form>

            <h3 class="text-lg font-semibold mt-6">Detail Produk</h3>
            <div class="overflow-x-auto mb-4 flex justify-end">
                <a href="{{ route('kasir.transaksi.cetak', $transaksi->id_transaksi) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Cetak Transaksi
                </a>
                <a href="{{ route('kasir.detail.tambah', $transaksi->id_transaksi) }}" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-900 text-blue-700 text-sm font-semibold">
                     + Tambah Detail Produk
                 </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">No</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Nama Produk</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Qty</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Harga</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Sub Total</th>
                            <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->detailTransaksi as $detail)
                            <tr class="border-b">
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $detail->nama_produk }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $detail->qty }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center">
                                    
                                    <form action="{{ route('kasir.detail.hapusProdukDetailTransaksi', [$detail->id_transaksi, $detail->no_produk]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Hapus detail ini?')">🗑️</button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
