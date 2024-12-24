<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaksi</title>
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
    <div class="relative flex items-center space-x-6">
        <div class="group">
            <div class="text-white relative cursor-pointer">
                <span class="relative">
                    <span class="text-lg ml-6 pl-6">🔔</span>
                    @if ($lowStockProducts->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
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
<div class="p-8 bg-gray-50 rounded-lg shadow-md">
    <!-- Page Title and Button -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Manage Transaksi</h2>
        <button 
            onclick="location.href='{{ route('kasir.transaksi.create') }}'" 
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            + Transaksi
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200 border-b">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Transaksi ID</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Nama Pelanggan</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Tanggal Transaksi</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Servis</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Keterangan Servis</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Total Harga</th>
                    <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $item->id_transaksi }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->nama_pelanggan }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->tanggal_transaksi }}</td>
                        <td class="py-3 px-4 border-b">Rp {{ number_format($item->servis, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->Keterangan_Service }}</td> 
                        <td class="px-6 py-4 border-b">
                            Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 border-b text-center space-x-2">
                            <!-- Edit Transaction -->
                            <a href="/Kasir/transaksi/edit/{{ $item->id_transaksi }}" class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </a>
                            
                            <!-- Delete Transaction -->
                            <form action="{{ route('kasir.transaksi.destroy', $item->id_transaksi) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                            </form>

                            <!-- Detail Transaction -->
                            <a href="{{ route('kasir.detail.show', $item->id_transaksi) }}" class="text-2xl">
                                📄
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4">
        <div class="text-sm text-gray-600">Menampilkan 1 hingga 5 dari 10 entri</div>
        <div class="flex items-center space-x-1">
            <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-l hover:bg-gray-400">
                Sebelumnya
            </button>
            <button class="px-3 py-1 border bg-blue-600 text-white">1</button>
            <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">2</button>
            <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">3</button>
            <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-r hover:bg-gray-400">
                Selanjutnya
            </button>
        </div>
    </div>
</div>

</body>

</html>
