<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function findById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}
