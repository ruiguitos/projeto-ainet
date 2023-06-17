<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientePost;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref');
        $users = User::select('id','name','email','user_type','blocked','photo_url');
        $clients = User::where('user_type', 'C')->paginate(10);

        return view('clients.index', compact('users', 'customers', 'clients'));

    }
    /*
    public function index(Request $request): View
    {
        $departamentos = Departamento::all();
        $filterByDepartamento = $request->departamento ?? '';
        $filterByNome = $request->name ?? '';
        $docenteQuery = Docente::query();
        if ($filterByDepartamento !== '') {
            $docenteQuery->where('departamento', $filterByDepartamento);
        }
        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $docenteQuery->whereIntegerInRaw('user_id', $userIds);
        }
        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        //$docentes = $docenteQuery->paginate(10);
        $docentes = $docenteQuery->with('departamentoRef', 'user')->paginate(10);
        return view('docentes.index', compact('docentes', 'departamentos', 'filterByDepartamento', 'filterByNome'));
    }*/

    public function show(Customer $customer ): View
    {
        $customer->load('customers');
        return view('clientes.index');
    }
}
