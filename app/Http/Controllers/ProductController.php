<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('admin.products.index', compact('products', 'categories', 'ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $data['created_by'] = $data['updated_by'] = auth()->id();
        if($request->file('img'))
            $data['img'] = $request->file('img')->store('images/products');

        $product = Product::create( $data );
        foreach ($data['product_id'] as $key => $item) {
            ProductDetail::create([
                'qty' => $data['qty'][$key],
                'price' => $data['price'][$key],
                'amount' => $data['amount'][$key],
                'ingredient_id' => $item,
                'product_id' => $product->id,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);
        }

        return back()->with(['message'=>__('locale.save', ['param'=>$product->category->name])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'ingredients', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except(['_token']);

        $product = Product::find($id);
        if($request->file('img'))
            $data['img'] = $request->file('img')->store('images/products');

        $qty = $data['product']['qty'] - $product->qty;


        $product->update( $data['product'] );
        foreach ($product->product_details as $item) $item->delete();
        foreach ($data['ingredient_id'] as $key => $item) {
            $details = ProductDetail::create([
                'qty' => $data['qty'][$key],
                'price' => $data['price'][$key],
                'amount' => $data['amount'][$key],
                'ingredient_id' => $item,
                'product_id' => $product->id,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);
            $details->ingredient->update(['qty'=>$details->ingredient->qty - $data['qty'][$key] * $qty]);
        }

        return back()->with(['message'=>__('locale.update', ['param'=>$product->category->name])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return back()->with(['message'=>__('locale.delete', ['param'=>__('locale.product', ['suffix'=>'', 'prefix'=>''])])]);
    }
}
