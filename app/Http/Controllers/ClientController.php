<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use App\Cart;
use App\Client;
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Stripe;
use Session;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class ClientController extends Controller
{
    
    public function home(){
        $sliders = Slider::where('status',1)->get();
        $produits = Product::where('status',1)->get();
        $categories = Product::where('status',1)->get();
        return view('client.home')->with('sliders',$sliders)->with('produits', $produits)->with('categories', $categories);
    }
    public function shop(){
        $categories = Category::get();
        $produits = Product::where('status',1)->get();
        return view('client.shop')->with('categories',$categories)->with('produits', $produits);
    }
    public function select_par_cat($name){
        $categories = Category::get();
        $produits = Product::where('product_category', $name)->where('status',1)->get();
        return view('client.shop')->with('categories', $categories)->with('produits', $produits);

    }
    public function ajouter_au_panier($id){
        $produit = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($produit, $id);
        Session::put('cart', $cart);
        //dd(Session::get('cart'));
        return redirect('/shop');

    }
    public function panier(){
        if(!Session::has('cart')){
         return view('client.cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }
    public function modifier_panier(Request $request, $id){
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);
        return redirect('/panier');

    }
    public function retirer_produit($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        return redirect('/panier');

    }
    public function paiement(){
        if (!Session::has('client')) {
            # code...
            return view('client.login');
        }
        if (!Session::has('cart')) {
            return view('client.cart');
        }
        return view('client.checkout');
    }
    public function payer(Request $request){
        if (!Session::has('cart')) {
            return view('client.cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_51IsV1NBofrH0UEPt0sVwdooNW2f2Q1ArukqauR8uThWG69ffrTr5W41XiD1VkST2FRncG02GnRNWreNCOXvFL84M00l9X3ekZu');
        try{
           $charge =  Charge::create(Array(
               "amount" => $cart->totalPrice *100,
               "currency" => "usd",
               "source" =>$request->input('stripeToken'), // obtainded with stripe.js
               "description" => "test charge"
           ));
           $order = new Order();
           $order->nom = $request->input('name');
           $order->adresse = $request->input('address');
           $order->panier = serialize($cart);
           $order->payement_id = $charge->id;
           $order->save();
           $orders = Order::where('payement_id', $charge->id)->get();
           $orders->transform(function($order, $key){
               $order->panier = unserialize($order->panier);
               return $order;
           });
              $email = Session::get('client')->email;
               Mail::to($email)->send(new SendMail($orders));
        }
        catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect('/paiement');
        }
        Session::forget('cart');
        //Session::put('success', 'Purchase accomplished successfully !')
        return redirect('/panier')->with('status', 'votre achat accompli avec succès');
        
    }
    public function creer_compte(Request $request){
        $this->validate($request, ['email' => 'email|required|unique:clients',
                                   'password' => 'required |min:4'
                                   ]);
        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return back()->with('status', 'Votre compte à été créé avec succès');
    }
    public function acceder_compte(Request $request){
        $client = Client::where('email', $request->input('email'))->first();
        if ($client) {
            # code...
            if (Hash::check($request->input('password'), $client->password)) {
                # code...
                Session::put('client', $client);
                return redirect('/shop');
            }else{
                return back()->with('status', 'Mauvais mot de passe ou email');

            }
        }else{
            return back()->with('status', 'Vous n'."'". 'avez de compte');
        }
    }
    public function logout(){
        Session::forget('client');
        return back();
    }
    public function client_login(){
        return view('client.login');
    }
    public function signup(){
        return view('client.signup');
    }
}