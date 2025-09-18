<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return CategoryResource::collection($this->categoryService->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = $this->categoryService->create($data);
        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryService->findById($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category = $this->categoryService->update($id, $data);
        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
