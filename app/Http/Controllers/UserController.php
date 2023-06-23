<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorPost;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    public function indexAdmins(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->orderBy('id','asc')
            ->orderBy('name','asc')
            ->where('user_type', 'A')
            ->paginate(18);
        return view('users.admins.index', compact('users'));
    }

    public function indexClientes(): View
    {
        //$customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref');
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->orderBy('id','asc')
            ->orderBy('name','asc')
            ->where('user_type', 'C')
            ->paginate(18);
        return view('users.clientes.index', compact('users'));
    }

    public function indexEmpregados(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->orderBy('id', 'asc')
            ->orderBy('name', 'asc')
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

    public function edit(User $User)
    {
        return view('users.admins.edit')
            ->withAdmins($User)
            ->withClientes($User)
            ->withEmpregados($User);
    }

    public function create(User $User)
    {
        return view('users.admins.create')
            ->withAdmins($User)
            ->withClientes($User)
            ->withEmpregados($User);
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        User::create($validated_data);
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'Utilizador(a) "' . $validated_data['nome'] . '" foi criado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(UserPost $request, User $User)
    {
        $validated_data = $request->validated();
        $User->fill($validated_data);
        $User->save();
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'Utilizador(a) "' . $User->name . '" foi alterado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $User)
    {
        $oldName = $User->nome;
        try {
            $User->delete();
            return redirect()->route('users.admins.index')
                ->with('alert-msg', 'Utilizador(a) "' . $User->name . '" foi apagado(a) com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.admins.admin')
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a)"' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('users.admins.admin')
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a)"' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

}
