<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::all();

        // $data= select * from `products`;

        return  view('Product', ["Products" => $data]);

        // return view('Product');


    }
    function detail($id)
    {
        $data = Product::find($id);

        return  view('detail', ["Products" => $data]);
    }
    function addToCart(Request $req)
    {
        if ($req->('user')) {

            $cart=new Cart;
            $cart->user_id=$req->('user')['id'];
            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('');

        } else {
            return redirect('/login');
        }
    }
     static function cartItem()
    {
        $userId=Session::get('user');
        return Cart::where('user_id',$userId);
    }
    function cartList()
    {
        $userId=Session::get('user')['id'];
        $products=DB::tables('table')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();

        return view('cartlist',['products'=>$products]);
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $total=$products=DB::tables('table')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');

        return view('ordernow','total'=>$total);
    }
    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
        $allCart=Cart::where('user_id',$userId)->get();
        foreach($Cart as $cart)
        {
            $order= new Order;
            $order->product_id=$cart['product_id'];
            $order->user_id=$cart['user_id'];
            $order->status="Pending";
            $order->payment_method=$req->payment;
            $order->payment_status="Pending";
            $order->address=$req->address;
            // Cart::where('user_id',$userId)->delete();
        }
         $req->input();
         return redirect('/');
    }
    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::tables('table')
        ->join('orders.product_id','=','products.id')
        ->where('orders.user_id',$userId);

        return view('myorders',['orders'=>$orders]);
    }
}
