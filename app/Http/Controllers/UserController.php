<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
//    public function showClientes()
//    {
//        $users = User::where('user_type', 'C')->get();
//
//        return view('clients.index', compact('users'));
//
//    }

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


    public function editAdmin(User $User)
    {
        return view('users.admins.edit')
            ->withUser($User);
    }

    public function createAdmin(User $User)
    {
        return view('users.admins.create')
            ->withUser($User);
    }

    public function storeAdmin(UserPost $request)
    {
        $validated_data = $request->validated();
        User::create($validated_data);
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'User "' . $validated_data['nome'] . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function updateAdmin(User $request, User $User)
    {
        $validated_data = $request->validated();
        $User->fill($validated_data);
        $User->save();
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'User "' . $User->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroyAdmin(Cor $User)
    {
        $oldName = $User->nome;
        try {
            $User->delete();
            return redirect()->route('users.admins.index')
                ->with('alert-msg', 'Cor "' . $User->name . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.admins.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Cor"' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('users.admins.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
