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
        $tshirt_images = Imagem::select('id', 'name', 'category_id', 'description', 'image_url')->paginate(20);
        $prices = Preco::all();

        return view('catalogo.index', compact('tshirt_images', 'prices'));
    }

    public function show($id)
    {
        $tshirt_images = Imagem::findOrFail($id);
        $prices = Preco::all();
        $categories = Categoria::all();
//        return view('catalogo.show', compact('tshirt_images', 'prices', 'categories'));

        return view('catalogo.show')
            ->withCatalogo($tshirt_images)
            ->withCatalogo($prices)
            ->withCatalogo($categories);
    }

//    public function filter(Request $request)
//    {
//        $categories = Categoria::all();
//        $query = Categoria::query();
//
//        // Filter by category
//        if ($request->has('category')) {
//            $category = $request->input('category');
//            $query->where('category_id', $category);
//        }
//
//        // Sort by name
//        if ($request->has('sort')) {
//            $sort = $request->input('sort');
//            $query->orderBy('name', $sort);
//        }
//
//        // Search by name
//        if ($request->has('search')) {
//            $search = $request->input('search');
//            $query->where('name', 'like', "%$search%");
//        }
//
//        $tshirts = $query->get();
//
//        return view('catalog.index', compact('tshirts', 'categories'));
//    }

}
