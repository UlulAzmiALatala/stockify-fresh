<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->productRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        $product = $this->productRepository->findById($id);
        return $this->productRepository->update($product, $data);
    }

    public function delete(int $id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->delete($product);
    }
}
