<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->paginate(10);
        return view('app.pages.admin.attributes.index', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name',
            'type' => 'required|in:text,select',
            'options' => 'nullable|string' // Opsi dikirim sebagai string dipisah koma
        ]);

        Attribute::create([
            'name' => $request->name,
            'type' => $request->type,
            // Jika ada opsi, ubah string menjadi array JSON
            'options' => $request->options ? explode(',', $request->options) : null
        ]);

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil ditambahkan.');
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name,' . $attribute->id,
            'type' => 'required|in:text,select',
            'options' => 'nullable|string'
        ]);

        $attribute->update([
            'name' => $request->name,
            'type' => $request->type,
            'options' => $request->options ? explode(',', $request->options) : null
        ]);

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil diperbarui.');
    }

    public function destroy(Attribute $attribute)
    {
        if ($attribute->products()->count() > 0) {
            return redirect()->route('attributes.index')
                ->with('error', 'Gagal! Atribut ini sedang digunakan oleh produk lain.');
        }

        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Atribut berhasil dihapus.');
    }
}
