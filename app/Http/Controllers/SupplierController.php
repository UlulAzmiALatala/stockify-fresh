<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- 1. Import Auth

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar supplier dengan paginasi dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm);
            });
        }

        $suppliers = $query->withCount('products')->latest()->paginate(10);

        // ==========================================================
        // == PERBAIKAN: Cek peran dan tampilkan view yang sesuai ==
        // ==========================================================
        if (Auth::user()->hasRole('admin')) {
            // Untuk Admin, tampilkan view CRUD lengkap
            return view('app.pages.admin.suppliers.index', compact('suppliers'));
        }

        if (Auth::user()->hasRole('manager')) {
            // Untuk Manajer, tampilkan view read-only
            return view('app.pages.manager.suppliers.index', compact('suppliers'));
        }

        return abort(403, 'Akses Ditolak');
    }

    /**
     * Menyimpan supplier baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data supplier yang sudah ada.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $supplier->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')
            ->with('success', 'Data supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier dari database.
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->products()->count() > 0) {
            return redirect()->route('suppliers.index')
                ->with('error', 'Gagal! Supplier masih memiliki produk terkait.');
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
