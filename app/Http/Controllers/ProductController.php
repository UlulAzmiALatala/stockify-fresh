<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk berdasarkan peran pengguna.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('sku', 'like', 'searchTerm');
            });
        }

        $products = $query->latest()->paginate(10);

        if (Auth::user()->hasRole('admin')) {
            // PERBAIKAN: Kirim semua data yang dibutuhkan oleh modal ke halaman index
            $categories = Category::orderBy('name')->get();
            $suppliers = Supplier::orderBy('name')->get();
            $attributes = Attribute::orderBy('name')->get();
            return view('app.pages.admin.products.index', compact('products', 'categories', 'suppliers', 'attributes'));
        }

        if (Auth::user()->hasRole('manager')) {
            return view('app.pages.manager.products.index', compact('products'));
        }

        return abort(403, 'Akses Ditolak');
    }

    /**
     * Menyimpan produk baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'required|string|max:100|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);

        // Jika ada atribut yang dikirim, sinkronkan
        if ($request->has('attributes')) {
            $product->attributes()->sync($request->attributes);
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data produk yang sudah ada.
     */
    public function update(Request $request, Product $product)
    {
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

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $path = $request->file('image')->store('public/products');
            $validated['image'] = $path;
        }

        $product->update($validated);

        // Sinkronkan atribut
        if ($request->has('attributes')) {
            $product->attributes()->sync($request->attributes);
        } else {
            $product->attributes()->detach(); // Hapus semua jika tidak ada yang dipilih
        }

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        if ($product->stockTransactions()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Gagal! Produk ini memiliki riwayat transaksi stok.');
        }

        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->attributes()->detach();
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Method untuk menampilkan detail produk (digunakan oleh Manajer).
     */
    public function show(Product $product)
    {
        $product->load(['category', 'supplier']);
        if (Auth::user()->hasRole(['manager', 'admin'])) {
            return view('app.pages.manager.products.show', compact('product'));
        }
        return abort(403, 'Anda tidak memiliki izin untuk melihat halaman ini.');
    }

    /**
     * PERBAIKAN: Method ini tidak lagi menampilkan halaman, jadi kita nonaktifkan.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * PERBAIKAN: Method ini tidak lagi menampilkan halaman, jadi kita nonaktifkan.
     */
    public function edit(Product $product)
    {
        abort(404);
    }
}
