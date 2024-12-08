<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Log; // Menambahkan import untuk Log

class ProductMenuController extends Controller
{
    // Menampilkan halaman produk
    public function index()
    {
        $products = Produk::with('kategori')->paginate(10);

        // Konversi gambar binary ke Base64
        foreach ($products as $product) {
            if ($product->gambar_produk) {
                $product->gambar_produk = 'data:image/png;base64,' . base64_encode($product->gambar_produk);
            }
        }

        return view('Owner.productread', compact('products'));
    }

    // Menampilkan form untuk tambah produk
    public function create()
    {
        // Ambil semua kategori dari tabel 'kategori'
        $categories = Kategori::all();

        // Kirim kategori ke view
        return view('Owner.productcreate', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'id_produk' => 'required|unique:products,id_produk|integer',
                'kode_kategori' => 'required|exists:kategori,kode_kategori',
                'nama_produk' => 'required|max:35',
                'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'stok' => 'required|integer',
            ]);

            // Save the product
            Produk::create([
                'id_produk' => $request->id_produk,
                'kode_kategori' => $request->kode_kategori,
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => file_get_contents($request->file('gambar_produk')->getRealPath()),
                'stok' => $request->stok,
            ]);

            return redirect()->route('productmenu.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error saving product: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat menyimpan produk.');
        }
    }


    // Menampilkan form edit produk
    public function edit($id_produk)
    {
        $product = Produk::findOrFail($id_produk);
        $categories = Kategori::all();  // Ambil semua kategori

        // Konversi gambar binary ke Base64 untuk ditampilkan di form edit
        if ($product->gambar_produk) {
            $product->gambar_produk = base64_encode($product->gambar_produk); // Encode gambar menjadi Base64
        }

        return view('Owner.productedit', compact('product', 'categories'));
    }

    // Mengupdate data produk
    public function update(Request $request, $id_produk)
    {
        $product = Produk::findOrFail($id_produk);

        // Validasi seperti biasa, tetapi buat gambar_produk nullable (opsional) saat update
        $request->validate([
            'kode_kategori' => 'required|exists:kategori,kode_kategori',
            'nama_produk' => 'required|max:35',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // Gambar tidak wajib diupdate
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        // Jika ada gambar baru yang diunggah, proses dan simpan gambar dalam bentuk binary
        if ($request->hasFile('gambar_produk')) {
            $gambarBinary = file_get_contents($request->file('gambar_produk')->getRealPath()); // Mendapatkan gambar dalam bentuk binary
            $product->gambar_produk = $gambarBinary;  // Simpan gambar dalam bentuk binary ke database
        }

        // Update data produk
        $product->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id_produk)
    {
        $product = Produk::findOrFail($id_produk);
        $product->delete();

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil dihapus.');
    }
}
