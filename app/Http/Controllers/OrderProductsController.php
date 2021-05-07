<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\PriceList;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Mail\GeneralMail;


use Illuminate\Http\Request;

class OrderProductsController extends Controller
{
    

    public function trolley(Request $request){
        $dataProduct = array();
        $ids = explode(',', $request->cart);

        if ($ids != null) {

            foreach ($ids as $id) {

                $product = Product::findOrFail($id);
                array_push($dataProduct,$product);
    
            }   

        } else { 

            return redirect('/orders');

        }
        
        if(Auth::user()->role=='Ferretero'){
        
            $distributors = User::where('role', '=', 'Distribuidor')
                                ->where('country', "=", Auth::user()->country)->get();
            return view('orderProducts.index', compact('dataProduct','distributors'));


        }else{

            return view('orderProducts.index', compact('dataProduct'));
        }
        
        

    }

    /*

    public function (Request $request){

    
    if(in_array(null, $request->quantity) == false &&  $request->address != null ){

        if(Auth::user()->role=='Ferretero'){

            $sellerRole = 'Distribuidor';
            
        }else{

            $sellerRole = 'Administrador';
        }

        $buyerRole = Auth::user()->role;
        $buyerId = Auth::user()->id;
        $listId = Auth::user()->price_list_id;
        $list = PriceList::findOrFail($listId);
        $currency = $list->currency;
        $products = json_decode($request->dataProduct);
        $quantity = $request->quantity;
        $total= 0;

        $i = 0;

        foreach ($products as $product) {
            $price =  $product->price;
            $total += $price * intval($quantity[$i]); 
            $i++;
        }
        
        if (Auth::user()->role == "Distribuidor") {
                $sellerId = 1; 
        }elseif(Auth::user()->role == "Ferretero"){

                $sellerId = $request->seller_id;

        }
        

        $order = [

            'seller_role' => $sellerRole,
            'status' =>'Iniciado',
            'buyer_role' => $buyerRole,
            'currency' => $currency,
            'total' =>  $total,
            'coment' => $request->coment,
            'delivery_address' => $request->address,
            'seller_id' => $sellerId,
            'buyer_id' => $buyerId,


        ];


        $order = Order::create($order);
        $orderId = $order->id;
        $i=0;
        
        foreach ($products as $product){
            
            $orderProduct = new OrderProduct;

            $orderProduct->quantity = intval($quantity[$i]);
            $orderProduct->price = $product->price;
            $orderProduct->currency = $currency;
            $orderProduct->order_id = $orderId;
            $orderProduct->product_id = $product->id;
            //$orderProduct->coment = $request->coment;
            $orderProduct->save();
            $i++;
        
        }

        return redirect('/orders')->with('messageSuccess','Productos solicitados con éxito');
  

    }else{

        return redirect()->action('App\Http\Controllers\OrdersController@index');

    }
       

    }

    */

    public function bill(Request $request){

        if(in_array(null, $request->quantity) == false &&  $request->address != null ){
    
            if(Auth::user()->role=='Ferretero'){
    
                $sellerRole = 'Distribuidor';
                
            }else{
    
                $sellerRole = 'Administrador';
            }
    
            $buyerRole = Auth::user()->role;
            $buyerId = Auth::user()->id;
            $listId = Auth::user()->price_list_id;
            $list = PriceList::findOrFail($listId);
            $currency = $list->currency;
            $products = json_decode($request->dataProduct);
            $quantity = $request->quantity;
            $total = 0;
    
            $i = 0;
    
            foreach ($products as $product) {
                $price =  $product->price;
                $total += $price * intval($quantity[$i]); 
                $i++;
            }
            
            if (Auth::user()->role == "Distribuidor") {
                    $sellerId = 1; 
            }elseif(Auth::user()->role == "Ferretero"){
    
                    $sellerId = $request->seller_id;
    
            }
            
    
            $order = [
    
                'seller_role' => $sellerRole,
                'status' =>'Iniciado',
                'buyer_role' => $buyerRole,
                'currency' => $currency,
                'total' =>  $total,
                'coment' => $request->coment,
                'delivery_address' => $request->address,
                'seller_id' => $sellerId,
                'buyer_id' => $buyerId,
    
    
            ];
    
    
            $order = Order::create($order);
            $orderId = $order->id;
            $i=0;
            
            
            foreach ($products as $product){
                
                $orderProduct = new OrderProduct;
    
                $orderProduct->quantity = intval($quantity[$i]);
                $orderProduct->price = $product->price;
                $orderProduct->currency = $currency;
                $orderProduct->order_id = $orderId;
                $orderProduct->product_id = $product->id;
                //$orderProduct->coment = $request->coment;
                $orderProduct->save();
                $i++;
            
            }
            
            return redirect('/orders')->with('messageSuccess','Productos solicitados con éxito');
        } else {
            return redirect('/orders');
            
    
        }
    }

    public function showOrder(Request $request)
    {
        if ($request->role == 'Administrador') {
            $id = 1;
            $orders = Order::with('buyer')->where('seller_id', '=', $id)->get();
            return view('orders.showOrder', compact('orders'));
        } elseif ($request->role == 'Distribuidor') {

            $orders = Order::with('buyer')->where('seller_id','=', Auth::user()->id)->get();
            return view('orders.showOrder', compact('orders'));

        }
        

        
        

    }

    public function detailOrder(Request $request){


        $products = array();
        
        $orders = OrderProduct::where('order_id', '=', $request->id)->get();

        foreach($orders as $order){

            $product = Product::findOrFail($order->product_id);  
            array_push($products,$product);          

        }

        return view('orders.detailOrder', compact('orders','products'))->with('id', $request->id);

        
    }

    public function changeStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
        $user = User::find($order->buyer_id);
        $subject = "Cambio de estado de su pedido";
        $text = 'Sr o Sra '.$user->name.' el estado de su pedido con id '.$order->id.' paso a '.$order->status.', cordialmente el equipo de PCP plásticos';
        Mail::to($user->email)->send(new GeneralMail($subject, $text));
        return redirect('showOrders?role='.Auth::user()->role);
    }

    
    public function myOrders(){
        $userID = Auth::user()->id;
        $orders = Order::with('seller')->where('buyer_id', '=', $userID)->get();
        return view('orders.myOrders', compact('orders'));  
    }



}
    