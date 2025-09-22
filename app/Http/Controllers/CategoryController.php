<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori dengan paginasi dan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Logika pencarian berdasarkan nama kategori
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // withCount('products') sangat efisien untuk menghitung jumlah produk
        // latest() untuk mengurutkan dari yang terbaru
        // paginate(10) untuk membatasi data per halaman
        $categories = $query->withCount('products')->latest()->paginate(10);

        return view('app.pages.categories.index', compact('categories'));
    }

    /**
     * Menyimpan kategori baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // Membuat data baru
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data kategori yang sudah ada.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input, mengabaikan nama unik untuk kategori yang sedang diedit
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // Update data
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        // Tambahan: Cek jika kategori masih memiliki produk
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Gagal! Kategori masih memiliki produk terkait.');
        }

        $category->delete();

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
