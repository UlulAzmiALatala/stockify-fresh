<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{
    public function getAll()
    {
        return Supplier::latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function findById(int $id)
    {
        return Supplier::findOrFail($id);
    }

    public function update(Supplier $supplier, array $data)
    {
        $supplier->update($data);
        return $supplier;
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();
    }
}
