<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrdersController extends Controller
{
    public function index()
    { 
        $list_id = Auth::user()->price_list_id;
        $products = Product::where('list_id','=', $list_id)->get();
        return view('orders.index',compact('products'));
    }

}
