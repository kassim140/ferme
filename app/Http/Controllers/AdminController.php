<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function commandes(){
        $orders = Order::get();
        $orders->transform(function($order, $key){
            $order->panier = unserialize($order->panier);
            return $order;
        });
        return view('admin.commandes')->with('orders', $orders);
    }
}
