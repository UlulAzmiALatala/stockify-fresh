<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation; // <-- 1. Import WithValidation

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // ==========================================================
        // == PERBAIKAN: Logika untuk mencari ID berdasarkan nama ==
        // ==========================================================
        $category = Category::firstOrCreate(['name' => $row['nama_kategori']]);
        $supplier = Supplier::firstOrCreate(['name' => $row['nama_supplier']]);

        // Cek apakah produk dengan SKU yang sama sudah ada
        $product = Product::where('sku', $row['sku'])->first();

        if ($product) {
            // Jika sudah ada, update data produk tersebut
            $product->update([
                'name'           => $row['nama_produk'],
                'category_id'    => $category->id,
                'supplier_id'    => $supplier->id,
                'description'    => $row['deskripsi'],
                'purchase_price' => $row['harga_beli'],
                'selling_price'  => $row['harga_jual'],
                'minimum_stock'  => $row['stok_minimum'],
                // Stok tidak diupdate saat import, harus melalui transaksi
            ]);
            return null; // Tidak membuat model baru
        }

        // Jika belum ada, buat produk baru
        return new Product([
            'name'           => $row['nama_produk'],
            'sku'            => $row['sku'],
            'category_id'    => $category->id,
            'supplier_id'    => $supplier->id,
            'description'    => $row['deskripsi'],
            'purchase_price' => $row['harga_beli'],
            'selling_price'  => $row['harga_jual'],
            'stock'          => $row['stok_saat_ini'] ?? 0,
            'minimum_stock'  => $row['stok_minimum'] ?? 10,
        ]);
    }

    /**
     * Aturan validasi untuk setiap baris di file Excel.
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string',
            'sku' => 'required|string', // Validasi unique bisa ditambahkan di sini jika perlu
            'nama_kategori' => 'required|string',
            'nama_supplier' => 'required|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ];
    }
}
