<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Tampilkan daftar semua atribut.
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('app.pages.admin.attributes.index', compact('attributes'));
    }

    /**
     * Simpan atribut baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:attributes',
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
     * Hapus atribut dari database.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil dihapus.');
    }
}
