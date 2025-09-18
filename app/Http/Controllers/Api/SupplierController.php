<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        return SupplierResource::collection($this->supplierService->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
        ]);

        $supplier = $this->supplierService->create($data);
        return new SupplierResource($supplier);
    }

    public function show($id)
    {
        $supplier = $this->supplierService->findById($id);
        return new SupplierResource($supplier);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $id,
        ]);

        $supplier = $this->supplierService->update($id, $data);
        return new SupplierResource($supplier);
    }

    public function destroy($id)
    {
        $this->supplierService->delete($id);
        return response()->json(['message' => 'Supplier berhasil dihapus']);
    }
}
