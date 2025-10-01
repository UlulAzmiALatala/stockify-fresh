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
     * Menentukan judul kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'SKU',
            'Kategori',
            'Supplier',
            'Deskripsi',
            'Harga Beli',
            'Harga Jual',
            'Stok Saat Ini',
            'Stok Minimum',
        ];
    }

    /**
     * Memetakan data produk ke setiap baris di file Excel.
     */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->sku,
            $product->category->name ?? 'N/A',
            $product->supplier->name ?? 'N/A',
            $product->description,
            $product->purchase_price,
            $product->selling_price,
            $product->stock,
            $product->minimum_stock,
        ];
    }
}
