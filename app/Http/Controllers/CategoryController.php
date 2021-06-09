<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajoutercategorie()
    {
        return view('admin.ajoutercategorie');
    }
    public function sauvercategorie(Request $request)
    {

        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $categorie = new Category();

        $categorie->category_name = $request->input('category_name');

        $categorie->save();

        return Redirect('/ajoutercategorie')->with('status', 'Le catégorie ' .
            $categorie->category_name . ' à été ajouter avec succès');
    }
    public function categories()
    {
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }
    public function editcategorie($id)
    {
        $categorie = Category::find($id);
        return view('admin.editcategorie')->with('categorie', $categorie);
    }
    public function modifiercategorie(Request $request)
    {
        $this->validate($request, ['category_name' => 'required']);

        $categorie = Category::find($request->input('id'));

        $categorie->category_name = $request->input('category_name');

        $categorie->update();
        return redirect('/categories')->with('status', 'Le categorie '
            . $categorie->category_name . ' à été modifiée avec succès!');
    }
    public function supprimercategorie($id)
    {
        $categorie = Category::find($id);

        $categorie->delete();

        return redirect('/categories')->with('status', 'Le categorie '
            .$categorie->category_name . ' à été supprimée avec succès!');
    }
}