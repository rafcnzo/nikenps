<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class KasirTransaksiController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        $produk = Produk::all();
        return view('kasir.pos', compact('categories', 'produk'));
    }
    public function history()
    {
        $categories = Kategori::all();
        $produk = Produk::all();
        $transaksi = Transaksi::all();
        $detailTransaksi = DetailTransaksi::all();
        return view('kasir.Transaksi', compact('categories', 'produk', 'transaksi', 'detailTransaksi'));
    }

    public function showCategory($kode_kategori)
    {
        $kategori = Kategori::where('kode_kategori', $kode_kategori)->firstOrFail();
        $produk = Produk::where('kode_kategori', $kode_kategori)->get();
        $categories = Kategori::all(); // Menambahkan variabel $categories

        return view('kasir.pos', compact('kategori', 'produk', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_transaksi' => 'required|unique:transaksi,id_transaksi',
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:35',
            'plat_nomor' => 'required|string|max:15',
            'total_harga' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:produk,id',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'id_transaksi' => $validated['id_transaksi'],
                'tanggal' => $validated['tanggal_transaksi'],
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'plat_nomor' => $validated['plat_nomor'],
                'total' => $validated['total_harga'],
            ]);

            foreach ($validated['products'] as $product) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $product['id'],
                    'harga' => $product['price'],
                    'qty' => $product['quantity'],
                    'subtotal' => $product['price'] * $product['quantity'],
                ]);
            }

            DB::commit();
            return redirect()->route('kasir.transaksi.history')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('kasir.pos')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

        return view('kasir.transaksi_edit', compact('transaksi'));
    }

    public function update(Request $request, $id_transaksi)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|string|max:25',
        ]);

        $transaksi = Transaksi::findOrFail($id_transaksi);

        $transaksi->update($request->all());

        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil diubah.');
    }

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();
        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
