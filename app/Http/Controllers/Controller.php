<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcome() 
    {
        return view('welcome');
    }

    public function dashboard() 
    {
        $product = Product::count();
        $orders = auth()->user()->group_id == 3 ? Order::where('created_by', auth()->id())->get() : Order::all();
        return view('admin.dashboard', compact('product', 'orders'));
    }
}
