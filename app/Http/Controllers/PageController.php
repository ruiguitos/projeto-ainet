<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $tshirt_images = Tshirt::whereIn('id', $tshirt_images->pluck('category_id'))->get();

        return view('catalogo.index', ['tshirt_images' => $tshirt_images]);
    }
}
