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
//    public function showClientes(): View
//    {
//        $users = User::select('id', 'name', 'email', 'user_type', 'blocked')
//            ->where('user_type', 'C')
//            ->paginate(50);
//
//        return view('clients.index', compact('users'));
//
//    }

    public function indexAdmins(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->where('user_type', 'A')
            ->paginate(18);
        return view('users.admins.index', compact('users'));
    }

    public function indexClientes(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->where('user_type', 'C')
            ->paginate(18);
        return view('users.clientes.index', compact('users'));
    }

    public function indexEmpregados(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->where('user_type', 'E')
            ->paginate(18);

        return view('users.empregados.index', compact('users'));
    }

    public function toggleBlocked(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $users->blocked = !$users->blocked;
        $users->save();

        // Redirect or return response as needed
        return redirect()->back();
    }

}
