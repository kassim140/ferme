<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function ajouterproduit()
    {
        $categories = Category::All()->pluck('category_name', 'category_name');

        return view('admin.ajouterproduit')->with('categories', $categories);
    }
    public function sauverproduit(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);
        if ($request->hasFile('product_image')) {
            //1:get file name with ext
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //2:get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //3:get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //4: get file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $product = new Product();

        $product->product_name = $request->input('product_name');

        $product->product_price = $request->input('product_price');

        $product->product_category = $request->input('product_category');

        $product->product_image = $fileNameToStore;

        $product->status = 1;

        $product->save();

        return redirect('/produits')->with('success', 'Le produit ' . $product->product_name . '
         à été ajouté avec succès !');
    }
    public function produits()
    {
        $products = Product::get();
        return view('admin.produits')->with('products', $products);
    }
    public function editproduit($id)
    {

        $product = Product::find($id);

        $categories = Category::All()->pluck('category_name', 'category_name');

        return view('admin.editproduit')->with('product', $product)->with('categories', $categories);
    }
    public function modifierproduit(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);
        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');

        $product->product_price = $request->input('product_price');

        $product->product_category = $request->input('product_category');
        if ($request->hasFile('product_image')) {
            //1:get file name with ext
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //2:get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //3:get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //4: get file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if ($product->product_image !== 'noimage.jpg') {
                Storage::delete('public/product_images/ ' . $product->product_image);
            }
            $product->product_image = $fileNameToStore;
        }
        $product->update();
        return redirect('/produits')->with('success', 'Le produit ' . $product->product_name . '
        à été Modifié avec succès !');
    }
    public function deleteproduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/produits')->with('error', 'Le produit ' . $product->product_name . '
        à été supprimée avec succès !');
    }
    public function activeproduit($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->update();
        return redirect('/produits')->with('success', 'Le produit ' . $product->product_name . '
        à été Activé avec succès !');
    }
    public function desactiveproduit($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->update();
        return redirect('/produits')->with('error', 'Le produit ' . $product->product_name . '
        à été désactivé avec succès !');

    }
}