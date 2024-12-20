<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('details.product')->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    public function store(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $sale = Sale::create([
            'sale_date' => $request->sale_date,
            'total_price' => 0,
        ]);

        $totalPrice = 0;

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $price = $product->price * $productData['quantity'];
            $totalPrice += $price;

            $sale->details()->create([
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'price' => $price,
            ]);

            $product->decrement('stock', $productData['quantity']);
        }

        $sale->update(['total_price' => $totalPrice]);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
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
    public function destroy(Sale $sale)
    {
        foreach ($sale->details as $detail) {
            $detail->product->increment('stock', $detail->quantity);
        }

        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

}
