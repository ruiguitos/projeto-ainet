<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Preco;
use App\Models\Tshirt;
use App\Models\TshirtImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
//        joao
        $user = Auth::user();

        $items = Encomenda::select('orders.id', 'orders.status', 'orders.customer_id', 'orders.date', 'orders.total_price', 'orders.notes', 'orders.nif', 'orders.address', 'orders.payment_type', 'orders.payment_ref', 'orders.receipt_url',
            'order_items.id', 'order_items.order_id', 'order_items.tshirt_image_id', 'order_items.color_code', 'order_items.size', 'order_items.qty', 'order_items.unit_price', 'order_items.sub_total')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.customer_id', $user->id);
//        joao

        $total = 0;
        $valorDesconto = 0;
        $price = Preco::first();
        $qtyDiscount = $price->unit_price_own_discount;
        $catalogDiscount = $price->unit_price_catalog_discount;

        //if cart doesn't have products return the view
        if(session('cart') == null) {
            return view('cart.index')
                ->withTotal($total)
                ->withDesconto($valorDesconto);
        }
        //else
        foreach(session('cart') as $id) {
            //get total
            $total += $id['price'] * $id['quantity'];

            //add discount
            $aux = $id['quantity'] - ($id['quantity'] % $qtyDiscount);
            $aux2 = $aux / $qtyDiscount;
            $valorDesconto += $aux2 * $catalogDiscount;
        }
        $total -= $valorDesconto;
        return view('cart.index', compact('items'))
            ->withTotal($total)
            ->withDesconto($valorDesconto);
    }

    public function addToCart($id, Request $request)
    {
        $order = Tshirt::find($id);
        $price = Preco::find(1);
        $color = Cor::find($request->color_code);

        if (!$order) {
            abort(404);
        }

        if (!$color) {
            abort(404);
            return redirect()->back()->with('error', 'ERROR');
        }

        $cart = session()->get('cart');

        if (!$cart) {
            $cart[] = [
                "id" => $id,
                "name" => $order->name,
                "quantity" => $request->qty,
                "price" => $price->unit_price_catalog,
                "color_code" => $color->color_code,
                "size" => $request->size
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
        }

        for ($i = 0; $i < count($cart); $i++) {
            if (
                $cart[$i]['name'] == $order->name &&
                $cart[$i]['color_code'] == $color->color_code &&
                $cart[$i]['size'] == $request->size
            ) {
                $cart[$i]['quantity'] += $request->qty;
                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
            }
        }

        $cart[] = [
            "id" => $id,
            "name" => $order->name,
            "quantity" => $request->qty,
            "price" => $price->unit_price_catalog,
            "color_code" => $color->color_code,
            "size" => $request->size
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
    }


//    public function addToCart($id, Request $request)
//    {
//        $order = Tshirt::find($id);
//        $price = Preco::find('1');
//        $color = Cor::find($request->color_code);
//
//        if(!$order) {
//            abort(404);
//        }
//
//        $cart = session()->get('cart');
//
//        //if cart is empty then this is the first product
//        if(!$cart) {
//            $cart[] = [
//                "id" => $id,
//                "name" => $order->name,
//                "quantity" => $request->qty,
//                "price" => $price->unit_price_catalog,
////                "color_code" => $color->color_code,
//                "size" => $request->size
//            ];
//
//            session()->put('cart', $cart);
//
//            return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho com sucesso!');
//        }
//
//        //if cart isn't empty then check if this product exist and increment quantity
//        if(isset($cart)) {
//            //go true all cart items
//            for($i = 0; $i < count($cart); $i++) {
//                if($cart[$i]['name'] == $color->name) {
//                    if($cart[$i]['color'] == $color->name) {
//                        if($cart[$i]['size'] == $request->size) {
//                            //if item already exist add quantity
//                            $cart[$i]['quantity'] += $request->quantity;
//
//                            session()->put('cart', $cart);
//
//                            return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho com sucesso!');
//                        }
//                    }
//                }
//            }
//        }
//
//        //if item doesn't exist in cart then add to cart with quantity
//        $cart[] = [
//            "id" => $id,
//            "name" => $order->name,
//            "quantity" => $request->qty,
//            "price" => $price->unit_price_catalog,
////            "color_code" => $color->color_code,
//            "size" => $request->size
//        ];
//
//        session()->put('cart', $cart);
//
//        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho com sucesso!');
//    }

    public function updateCarrinho(Request $request)
    {
        if(isset($request->id) && isset($request->quantity)) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('sucesso', 'Carrinho atualizado com sucesso');
        }
    }
    public function removeCarrinho(Request $request)
    {
        if(isset($request->id)) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('sucesso', 'Produto removido com sucesso');
        }
    }

    //PAGAMENTO
    public function pagamento() {
        return view('cart.pagamento');
    }

    public function concluirPagamento(Request $request) {
        $dados = $request->validate([
            'notes' => 'nullable|sometimes|string|max:255',
            'nif' => 'required|int|digits:9',
            'endereco' => 'string|max:255',
            'tipo_envio' => 'required',
            'tipo_pagamento' => 'required',
            'ref_pagamento' => [($request['tipo_pagamento'] == 'PAYPAL' ? 'email' : 'digits:16')],
        ]);

        //passing data to email
        $total = 0;
        $valorDesconto = 0;
        $price = Preco::first();
        $qty_discount = $price->qty_discount;
        $catalogDiscount = $price->unit_price_catalog_discount;

        $cart = session()->get('cart');

        if(session('cart') != null) {
            foreach($cart as $id) {
                //get total
                $total += $id['price'] * $id['quantity'];

                //add discount
                $aux = $id['quantity'] - ($id['quantity'] % $qty_discount);
                $aux2 = $aux / $qty_discount;
                $valorDesconto += $aux2 * $catalogDiscount;
            }
            $total -= $valorDesconto;

            Mail::to(auth()->user()->email)->send(new OrderSent($dados, $total));

        }

        $encomenda = Encomenda::create([
            'status' => 'pending',
            'customer_id' => auth()->user()->id,
            'date' => date("Y-m-d"),
            'total_price' => $total,
            'notes' => $request['notes'],
            'nif' => $request['nif'],
            'address' => $request['address'],
            'payment_type' => $request['payment_type'],
            'payment_ref' => $request['payment_ref'],
            'receipt_url' => null,
        ]);
        $encomenda->save();

        foreach(session('cart') as $id) {
            $product = TShirt::where('nome', $id['name'])->get();
            $cor = Cor::where('nome', $id['color'])->get();
            $unit_price = $price->preco_un_catalogo;
            $tshirt = Tshirt::create([
                'order_id' => $encomenda->id,
                'tshirt_image_id' => $product[0]['id'],
                'color_code' => $cor[0]['codigo'],
                'size' => $id['tamanho'],
                'qty' => $id['quantity'],
                'unit_price' => $unit_price,
                'sub_total' => $id['quantity']*$id['price'],
            ]);
            $tshirt->save();
        }

        $cart = session()->forget('cart');

        return redirect('/')->with('sucesso', 'Dados da Encomenda Enviados para o Email');
    }
}
