<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Estoque';    
            $stock = Stock::limit(20)->orderBy('id', 'DESC')->get();            
            return view('admin.stock.index', compact('title', 'stock'));
        } catch (QueryExceprion $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    /**
     * Get Products by code .
     */
    public function getProduct($code)
    {
        try {
            $product = Product::where('code', $code)->get(['id', 'code', 'name', 'stock'])->first();
            return response()->json([
                'p' => $product
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = Product::where('code', $request->product_code)->first();
            $product->stock = $request->new_stock;

            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->description = $request->description;
            $stock->current_stock = $product->stock;
            $stock->new_stock = $request->new_stock;
            $stock->save();
            $product->save();
            return response()->json([
                'trigger' => alert(
                    'Estoque alterado com sucesso!',
                    1500,
                    route('admin.stock.index')
                ),
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}