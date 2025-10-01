<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;

class ProductImportExportController extends Controller
{
    /**
     * Memicu download file Excel berisi data produk.
     */
    public function export()
    {
        return Excel::download(new ProductsExport, 'daftar-produk.xlsx');
    }

    /**
     * Mengimpor data produk dari file Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new ProductsImport, $request->file('file'));
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Gagal mengimpor data. Pastikan format file Excel sudah benar. Pesan error: ' . $e->getMessage());
        }

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diimpor.');
    }
}
