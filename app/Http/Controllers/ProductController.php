<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan paginasi, pencarian, dan relasi.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        // Logika pencarian berdasarkan nama produk atau SKU
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('sku', 'like', $searchTerm);
            });
        }

        $products = $query->latest()->paginate(10);

        return view('app.pages.products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        // Mengambil semua kategori dan supplier untuk ditampilkan di form
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('app.pages.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Menyimpan produk baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'required|string|max:100|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Handle unggahan gambar
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }


    /**
     * Menampilkan form untuk mengedit data produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('app.pages.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Memperbarui data produk yang sudah ada.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle unggahan gambar jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('public/products');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        // Pengecekan apakah produk memiliki transaksi stok
        if ($product->stockTransactions()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Gagal! Produk ini memiliki riwayat transaksi stok.');
        }

        // Hapus gambar dari storage jika ada
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
