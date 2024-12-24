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

     <main class="p-6">
         <div class="flex justify-between gap-6">
             <!-- Kategori dan Produk -->
             <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg w-2/3">
                 <h1 class="text-2xl font-bold mb-4 text-indigo-600">Produk Bengkel</h1>
                 <div class="grid grid-cols-3 gap-4 mb-4">
                     <!-- Daftar produk akan ditampilkan di sini -->
                 </div>
             </div>

             <!-- Form Pesanan -->
             <div class="w-1/3 pl-1 pr-3">
                 <form action="/Kasir/transaksi" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full">
                     @csrf
                     <div class="mb-4">
                         <label for="id_transaksi" class="text-lg font-semibold">ID Transaksi</label>
                         <input type="text" id="id_transaksi" name="id_transaksi" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                     </div>

                     <div class="mb-4">
                         <label for="tanggal_transaksi" class="text-lg font-semibold">Tanggal Transaksi</label>
                         <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                     </div>

                     <div class="mb-4">
                         <label for="nama_pelanggan" class="text-lg font-semibold">Nama Pelanggan</label>
                         <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                     </div>

                     <div class="mb-4">
                         <label for="keterangan_service" class="text-lg font-semibold">Keterangan Service</label>
                         <select id="keterangan_service" name="Keterangan_Service" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                             <option value="">Pilih Keterangan Service</option>
                             <option value="Power Steering Pump">Power Steering Pump</option>
                             <option value="Seal Kit">Seal Kit</option>
                             <option value="Rotary Kit">Rotary Kit</option>
                             <option value="Housing Pump">Housing Pump</option>
                             <option value="Pressure Hose">Pressure Hose</option>
                             <option value="Back Hose">Back Hose</option>
                             <option value="Supply Hose">Supply Hose</option>
                             <option value="Boot Steer">Boot Steer</option>
                             <option value="Insulock Ties L/R">Insulock Ties L/R</option>
                             <option value="Rack Steer">Rack Steer</option>
                             <option value="Control Valve">Control Valve</option>
                             <option value="Tie Rod / Long Tie Rod L/R">Tie Rod / Long Tie Rod L/R</option>
                             <option value="ATF Oil">ATF Oil</option>
                             <option value="Grease">Grease</option>
                             <option value="Service Charge/Setting">Service Charge/Setting</option>
                         </select>
                     </div>

                     <div class="mb-4">
                         <label for="servis" class="block text-lg font-semibold">Service</label>
                         <input type="number" id="servis" name="servis" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required oninput="updateTotalHarga()" />
                     </div>

                     <div class="mb-4">
                         <label for="total_harga" class="block text-lg font-semibold">Total Harga</label>
                         <input type="text" id="total_harga" name="total_harga" class="border-2 border-indigo-500 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                     </div>

                     <div class="flex justify-between">
                         <button type="reset" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Bersihkan</button>
                         <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">Simpan Transaksi</button>
                     </div>
                 </form>
             </div>
         </div>
     </main>

     <script>
         function updateTotalHarga() {
             const servis = document.getElementById('servis').value;
             const totalHargaInput = document.getElementById('total_harga');
             totalHargaInput.value = servis; // Mengatur total harga sama dengan servis
         }
     </script>

 </body>

 </html>