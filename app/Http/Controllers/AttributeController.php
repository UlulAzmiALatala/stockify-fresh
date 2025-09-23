<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Tampilkan daftar semua atribut dengan paginasi.
     */
    public function index()
    {
        // Mengambil data dengan urutan terbaru dan paginasi
        $attributes = Attribute::latest()->paginate(10);
        return view('app.pages.admin.attributes.index', compact('attributes'));
    }

    /**
     * Simpan atribut baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name',
        ]);

        Attribute::create($request->all());

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil ditambahkan.');
    }

    /**
     * Perbarui atribut yang sudah ada.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name,' . $attribute->id,
        ]);

        $attribute->update($request->all());

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil diperbarui.');
    }

    /**
     * Hapus atribut dari database setelah pengecekan.
     */
    public function destroy(Attribute $attribute)
    {
        // PENTING: Cek apakah atribut ini terhubung dengan produk manapun.
        if ($attribute->products()->count() > 0) {
            return redirect()->route('attributes.index')
                ->with('error', 'Gagal! Atribut ini sedang digunakan oleh produk lain.');
        }

        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil dihapus.');
    }
}
