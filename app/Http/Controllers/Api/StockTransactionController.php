<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Services\StockTransactionService;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = $this->stockTransactionService->getAllTransactions();
        return StockTransactionResource::collection($transactions);
    }

    public function stockIn(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);
        $data['user_id'] = auth()->id();

        $transaction = $this->stockTransactionService->processStockIn($data);
        return new StockTransactionResource($transaction);
    }

    public function stockOut(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);
        $data['user_id'] = auth()->id();

        $transaction = $this->stockTransactionService->processStockOut($data);
        return new StockTransactionResource($transaction);
    }
}
