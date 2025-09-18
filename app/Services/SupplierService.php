<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAll()
    {
        return $this->supplierRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->supplierRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        $supplier = $this->supplierRepository->findById($id);
        return $this->supplierRepository->update($supplier, $data);
    }

    public function delete(int $id)
    {
        $supplier = $this->supplierRepository->findById($id);
        $this->supplierRepository->delete($supplier);
    }
}
