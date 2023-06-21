<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

//use App\Http\Requests\ClientePost;


class CustomerController extends Controller
{

//    public function index(): View
//    {
////        dd('aqui');
//        $users = User::select('users.id', 'users.name', 'users.email', 'users.user_type', 'users.blocked', 'users.photo_url',
//            'customers.nif', 'customers.address', 'customers.default_payment_type', 'customers.default_payment_ref')
//            ->where('users.user_type', 'C')
//            ->join('customers', 'users.id', '=', 'customers.id');
//
//        return view('perfil.index', compact('users'));
//    }

        public function index(): View
    {
        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(5000);

        return view('perfil.index', compact('customers'));
    }

}
