<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::with(['category', 'supplier'])->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findById(int $id)
    {
        return Product::with(['category', 'supplier'])->findOrFail($id);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
