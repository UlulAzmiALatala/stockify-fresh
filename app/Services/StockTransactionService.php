<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\StockTransactionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockTransactionService
{
    protected $stockTransactionRepository;
    protected $productRepository;

    public function __construct(
        StockTransactionRepository $stockTransactionRepository,
        ProductRepository $productRepository
    ) {
        $this->stockTransactionRepository = $stockTransactionRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllTransactions()
    {
        return $this->stockTransactionRepository->getAll();
    }

    public function processStockIn(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->productRepository->findById($data['product_id']);

            // Tambah stok produk
            $product->increment('stock', $data['quantity']);

            // Catat transaksi barang masuk
            $data['type'] = 'Masuk';
            return $this->stockTransactionRepository->create($data);
        });
    }

    public function processStockOut(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->productRepository->findById($data['product_id']);

            // Validasi: Cek apakah stok mencukupi
            if ($product->stock < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok produk tidak mencukupi. Sisa stok: ' . $product->stock,
                ]);
            }

            // Kurangi stok produk
            $product->decrement('stock', $data['quantity']);

            // Catat transaksi barang keluar
            $data['type'] = 'Keluar';
            return $this->stockTransactionRepository->create($data);
        });
    }
}
