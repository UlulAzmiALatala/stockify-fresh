<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Logika sederhana untuk import.
        // CATATAN: Ini mengasumsikan category_id dan supplier_id ada di Excel.
        // Untuk aplikasi nyata, Anda perlu logika tambahan untuk mencari ID berdasarkan nama.
        return new Product([
            'name'           => $row['nama_produk'],
            'sku'            => $row['sku'],
            'category_id'    => $row['category_id'],
            'supplier_id'    => $row['supplier_id'],
            'description'    => $row['deskripsi'],
            'purchase_price' => $row['harga_beli'],
            'selling_price'  => $row['harga_jual'],
            'stock'          => $row['stok_saat_ini'] ?? 0,
            'minimum_stock'  => $row['stok_minimum'] ?? 10,
        ]);
    }
}
