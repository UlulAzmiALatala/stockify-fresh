<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function getAll()
    {
        return StockTransaction::with(['product', 'user'])->latest()->paginate(15);
    }

    public function create(array $data)
    {
        return StockTransaction::create($data);
    }
}
