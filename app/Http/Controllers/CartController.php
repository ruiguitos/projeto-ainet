<?php

namespace App\Http\Controllers;

use App\Mail\MailOrder;
use App\Mail\MailRegister;
use App\Models\TshirtImage;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request){
        if(!Session::has('cart')){
            return view('front_pages.shoping-cart', ['items' =>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('front_pages.shoping-cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice()]);
    }

    public function checkout(Request $request){
        if(!Session::has('cart')){
            return view('front_pages.checkout', ['items' =>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('front_pages.checkout', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice()]);
    }

    public function addToCart(Request $request, $id){
        if($request->qty == null){
            $request->qty = 1;
        }
        $orderItemimage = TshirtImage::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($orderItemimage, $orderItemimage->id, $request->qty,$request->size,$request->color);
        $request->session()->put('cart',$cart);
        return redirect()->back()->with('success', 'T-shirt com imagem adicionada com sucesso ao carrinho');
    }

    public function removeFromCart(Request $request, $index){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($index);

        $request->session()->put('cart',$cart);
        return redirect()->back()->with('success', 'T-shirt com Imagem removida do carrinho');
    }

    public function editItemFromCart(Request $request, $index, $operator){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->editQuantity($index,$operator);

        $request->session()->put('cart',$cart);
        if($operator == "+"){
            return redirect()->back()->with('success', 'Quantidade da t-shirt com imagem aumentada com sucesso');
        }elseif($operator == "-"){
            return redirect()->back()->with('success', 'Quantidade da t-shirt com imagem diminuida com sucesso');
        }

    }

    public function checkoutCart(Request $request)
    {
        $user = Auth::user();
        $oldCart = Session::get('cart');
        $totalPrice = Session::get('cart')->totalPrice();

        if ($user === null) {
            // Create new user and customer
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->password);
            $newUser->user_type = 'C';
            $newUser->blocked = 0;
            $newUser->save();

            $newCustomer = new Customer();
            $newCustomer->id = $newUser->id;
            $newCustomer->nif = $request->nif;
            $newCustomer->address = $request->address1 . ", " . $request->address2 . ", " . $request->address3;
            $newCustomer->default_payment_ref = $request->default_payment_ref;
            $newCustomer->default_payment_type = $request->default_payment_type;
            $newCustomer->save();

            $user = $newUser;
            Auth::login($user);
            Mail::to($user->email)->send(new MailRegister($user));
        }

        // Generate order
        $order = new Order();
        $order->status = "pending";
        $order->customer_id = $user->id;
        $order->date = Carbon::now()->toDateTimeString();
        $order->total_price = $totalPrice;
        $order->nif = $user->customer->nif;
        $order->address = $user->customer->address;
        $order->payment_type = $user->customer->default_payment_type;
        $order->payment_ref = $user->customer->default_payment_ref;
        $order->save();

        // Generate order items
        foreach ($oldCart->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->tshirt_image_id = $item['id'];
            $orderItem->color_code = $item['color'];
            $orderItem->size = $item['size'];
            $orderItem->qty = $item['qty'];
            $orderItem->unit_price = $item['price'] / $item['qty'];
            $orderItem->sub_total = $item['price'];
            $orderItem->timestamps = false;
            $orderItem->save();
        }

        // Generate receipt PDF

        // Clear session
        Session::forget('cart');
        Mail::to($user->email)->send(new MailOrder($order));

        return redirect()->route('myorders')->with('success', 'Encomenda criada com sucesso.');
    }
}
