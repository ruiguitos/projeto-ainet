<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Customer;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\View\View;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Storage;
//use App\Http\Requests\ClientePost;
//
//class CustomerController extends Controller
//{
//    public function indexAdmins() :View
//    {
////        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
//        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(20);
//
//        return view('users.admins.index', compact( 'users'));
//    }
//
//    public function indexClientes() :View
//    {
////        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
//        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(20);
//
//        return view('users.clientes.index', compact( 'users'));
//    }
//
//    public function indexEmpregados() :View
//    {
////        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
//        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')->paginate(20);
//
//        return view('users.empregados.index', compact( 'users'));
//    }
//}
