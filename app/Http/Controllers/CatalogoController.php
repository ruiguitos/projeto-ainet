<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use App\Models\Preco;
use App\Models\TShirt;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        $tshirt_images = Imagem::select('id', 'name', 'category_id', 'description', 'image_url')->paginate(35);
        $prices = Preco::all();

        $query = Imagem::query();


        return view('catalogo.index', compact('tshirt_images', 'prices'));
    }

    public function uploadEstampa() {

        return view('catalogo.estampa');
    }

    public function show($id)
    {
        $tshirt_images = Imagem::findOrFail($id);
        $prices = Preco::all();
        $categories = Categoria::select('id','name');

        return view('catalogo.details', compact('tshirt_images', 'prices', 'categories'));
    }


    public function filter(Request $request)
    {
        $categories = Preco::all();
        $query = Preco::query();

        // Filter by category
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category_id', $category);
        }

        // Sort by name
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('name', $sort);
        }

        // Search by name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        $tshirts = $query->get();

//        return view('catalog.index', compact('tshirts', 'categories'));

        return view('catalogo.index')
            ->withCatalogo($tshirts)
            ->withCategorias($categories);

    }

}
