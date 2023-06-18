<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    public function showClientes()
    {
        $users = User::where('user_type', 'C')->get();

        return view('clients.index', compact('users'));

    }

    public function indexAdmins(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(100);

        return view('users.admins.index', compact('users'));
    }

    public function indexClientes(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(50);

        return view('users.clientes.index', compact('users'));
    }

    public function indexEmpregados(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(100);

        return view('users.empregados.index', compact('users'));
    }

}
