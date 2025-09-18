<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        $category = $this->categoryRepository->findById($id);
        return $this->categoryRepository->update($category, $data);
    }

    public function delete(int $id)
    {
        $category = $this->categoryRepository->findById($id);
        $this->categoryRepository->delete($category);
    }
}
