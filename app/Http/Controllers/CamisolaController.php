<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use App\Models\Preco;
use App\Models\TShirt;
use Illuminate\Http\Request;

class CamisolaController extends Controller
{
//    public function index()
//    {
//        $tshirt = TShirt::select('id', 'order_id', 'tshirt_image_id', 'color_code', 'size', 'qty', 'unit_price', 'sub_total')->paginate(30);
//        $prices = Preco::all();
//
//        $query = TShirt::all();
//
//        return view('catalogo.camisola', compact('tshirt', 'prices'));
//
//    }

    public function index()
    {
        $tshirts = TShirt::paginate(5);
        $prices = Preco::all();

        $query = TShirt::all();

        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];


        return view('catalogo.camisola', compact('tshirts', 'prices', 'sizes'));

    }


    public function showTshirts()
    {
        // Retrieve the available sizes from the database or any other data source

    }



}
