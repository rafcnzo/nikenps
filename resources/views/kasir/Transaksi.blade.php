<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaksi</title>
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

    <!-- Content -->
    <div class="p-8">
        <!-- Page Title and Button -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manage Transaksi</h2>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Transaksi ID</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">tanggal transaksi</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Nama Pelanggan</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Plat Nomor</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Total harga</th>
                        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                        <tr>
                            <td class="py-3 px-4 border-b">{{ $item->id_transaksi }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->tanggal }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->nama_pelanggan }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->plat_nomor }}</td>
                            <td class="py-3 px-4 border-b">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b text-center space-x-2">
                                <a 
                                    href="/Kasir/transaksi/detail/{{ $item->id_transaksi }}" 
                                    class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <div class="text-sm text-gray-600">Showing 1 to 5 of 10 entries</div>
            <div class="flex items-center space-x-1">
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-l hover:bg-gray-400">
                    Previous
                </button>
                <button class="px-3 py-1 border bg-blue-500 text-white">1</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">2</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">3</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-r hover:bg-gray-400">
                    Next
                </button>
            </div>
        </div>
    </div>
</body>

</html>
