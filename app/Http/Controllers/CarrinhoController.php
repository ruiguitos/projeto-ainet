<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use App\Models\Preco;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $tshirt_images = Imagem::select('id', 'name', 'category_id', 'description', 'image_url')->paginate(20);
        $prices = Preco::all();

        $query = Imagem::query();


        return view('catalogo.index', compact('tshirt_images', 'prices'));
    }





}
