<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = auth()->user()->group_id == 3 ? Order::where('created_by', auth()->id())->orderByDesc('id')->get() : Order::orderByDesc('id')->get();
        $products = Product::where('qty', '>', 0)->get();
        return view('admin.orders.index', compact('products', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('qty', '>', 0)->get();
        return view('admin.orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $data['order']['ref'] = "BH-" .date('His');
        $data['order']['created_by'] = $data['order']['updated_by'] = auth()->id();
        $order = Order::create( $data['order'] );

        foreach ($data['product_id'] as $key => $item) {
            $details = OrderDetail::create([
                'qty' => $data['qty'][$key],
                'price' => $data['price'][$key],
                'amount' => $data['amount'][$key],
                'product_id' => $item,
                'order_id' => $order->id,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);
            $details->product->update(['qty'=>$details->product->qty - $data['qty'][$key]]);
        }
        return back()->with(['message'=>__('locale.save', ['param'=>__('locale.order', ['suffix'=>'', 'prefix'=>''])." | ".__('locale.ref').":".$order->ref])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::find($id);
        $products = Product::where('qty', '>', 0)->get();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');

        $order = Order::find($id);
        $order->update( $data['order'] );
        
        if(!empty($data['product_id'])) {
            foreach ($order->order_details as $item) {
                $item->product->update(['qty'=>$item->product->qty + $item->qty]);
                $item->delete();
            }
            foreach ($data['product_id'] as $key => $item) {
                $details = OrderDetail::create([
                    'qty' => $data['qty'][$key],
                    'price' => $data['price'][$key],
                    'amount' => $data['amount'][$key],
                    'product_id' => $item,
                    'order_id' => $order->id,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id()
                ]);
                $details->product->update(['qty'=>$details->product->qty - $data['qty'][$key]]);
            }
        }
        
        return redirect()->route('orders.index')->with(['message'=>__('locale.update', ['param'=>__('locale.order', ['suffix'=>'', 'prefix'=>''])." | ".__('locale.ref').":".$order->ref])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();

        return back()->with(['message'=>__('locale.delete', ['param'=>__('locale.order', ['suffix'=>'', 'prefix'=>''])])]);
    }
}
