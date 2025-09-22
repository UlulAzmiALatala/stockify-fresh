<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar supplier dengan paginasi dan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Logika pencarian berdasarkan nama, email, atau telepon supplier
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm);
            });
        }

        // withCount('products') untuk menghitung jumlah produk terkait supplier
        $suppliers = $query->withCount('products')->latest()->paginate(10);

        // Mengembalikan view dengan data suppliers
        return view('app.pages.suppliers.index', compact('suppliers'));
    }

    /**
     * Menyimpan supplier baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Membuat data supplier baru
        Supplier::create($request->all());

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data supplier yang sudah ada.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validasi input, mengabaikan data unik untuk supplier yang sedang diedit
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $supplier->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Update data supplier
        $supplier->update($request->all());

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
            ->with('success', 'Data supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier dari database.
     */
    public function destroy(Supplier $supplier)
    {
        // Pengecekan apakah supplier masih memiliki produk terkait
        if ($supplier->products()->count() > 0) {
            return redirect()->route('suppliers.index')
                ->with('error', 'Gagal! Supplier masih memiliki produk terkait.');
        }

        $supplier->delete();

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
