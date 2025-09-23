<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $attributes = Attribute::orderBy('name')->get();

        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.products.create', compact('categories', 'suppliers', 'attributes'));
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
            'product_attributes' => 'nullable|array', // Diubah untuk relasi
            'product_attributes.*.id' => 'required|exists:attributes,id',
            'product_attributes.*.value' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // Handle unggahan gambar
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/products');
                $validated['image'] = $path;
            }

            $product = Product::create($validated);

            // PENYEMPURNAAN: Menyimpan relasi many-to-many ke tabel pivot
            if ($request->has('product_attributes')) {
                $attributesToSync = [];
                foreach ($request->product_attributes as $attr) {
                    if (!empty($attr['id']) && !empty($attr['value'])) {
                        $attributesToSync[$attr['id']] = ['value' => $attr['value']];
                    }
                }
                $product->attributes()->sync($attributesToSync);
            }
        });

        return redirect()->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }


    /**
     * Menampilkan form untuk mengedit data produk.
     */
    public function edit(Product $product)
    {
        // Eager load relasi attributes untuk ditampilkan di form
        $product->load('attributes');
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $attributes = Attribute::orderBy('name')->get();

        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.products.edit', compact('product', 'categories', 'suppliers', 'attributes'));
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
            'product_attributes' => 'nullable|array', // Diubah untuk relasi
            'product_attributes.*.id' => 'required|exists:attributes,id',
            'product_attributes.*.value' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $product, $validated) {
            // Handle unggahan gambar jika ada gambar baru
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::delete($product->image);
                }
                $path = $request->file('image')->store('public/products');
                $validated['image'] = $path;
            }

            $product->update($validated);

            // PENYEMPURNAAN: Menyimpan relasi many-to-many ke tabel pivot
            $attributesToSync = [];
            if ($request->has('product_attributes')) {
                foreach ($request->product_attributes as $attr) {
                    if (!empty($attr['id']) && !empty($attr['value'])) {
                        $attributesToSync[$attr['id']] = ['value' => $attr['value']];
                    }
                }
            }
            $product->attributes()->sync($attributesToSync);
        });

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

        DB::transaction(function () use ($product) {
            // Hapus relasi di tabel pivot terlebih dahulu
            $product->attributes()->detach();

            if ($product->image) {
                Storage::delete($product->image);
            }

            $product->delete();
        });

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
