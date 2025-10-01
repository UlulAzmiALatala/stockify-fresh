<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua produk beserta relasi kategori dan supplier
        return Product::with(['category', 'supplier'])->get();
    }

    /**
     * PERBAIKAN: Mengubah judul kolom agar lebih ramah pengguna.
     */
    public function headings(): array
    {
        return [
            'nama_produk',
            'sku',
            'nama_kategori',
            'nama_supplier',
            'deskripsi',
            'harga_beli',
            'harga_jual',
            'stok_saat_ini',
            'stok_minimum',
        ];
    }

    /**
     * PERBAIKAN: Memetakan data agar menampilkan nama, bukan ID.
     */
    public function map($product): array
    {
        return [
            $product->name,
            $product->sku,
            $product->category->name ?? '', // Tampilkan nama kategori
            $product->supplier->name ?? '', // Tampilkan nama supplier
            $product->description,
            $product->purchase_price,
            $product->selling_price,
            $product->stock,
            $product->minimum_stock,
        ];
    }
}
