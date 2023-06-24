<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorPost;
use App\Http\Requests\UserPost;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PDOException;

class UserController extends Controller
{

    public function indexCount(): View
    {
        $ausers = User::where('user_type', 'A')->count();
        $eusers = User::where('user_type', 'E')->count();
        $cusers = User::where('user_type', 'C')->count();

        $ncategorias = Categoria::where('deleted_at', null)->count();

        $nEncomendasCanceladas = Encomenda::where('status', 'canceled')->count();
        $nEncomendasFechadas = Encomenda::where('status', 'closed')->count();
        $nTotalEncomendas = Encomenda::count('id');

        $ncores = Cor::where('deleted_at', null)->count();

        return view('dashboard.index', compact('ausers', 'eusers', 'cusers', 'ncategorias', 'ncores', 'nEncomendasCanceladas', 'nEncomendasFechadas', 'nTotalEncomendas'));
    }

    public function indexAdmins(): View
    {
//        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref')->paginate(20);
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->orderBy('id', 'asc')
            ->orderBy('name', 'asc')
            ->where('user_type', 'A')
            ->paginate(18);
        return view('users.admins.index', compact('users'));
    }

    public function indexClientes(): View
    {
        //$customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref');
        $users = User::select('id', 'name', 'email', 'user_type', 'blocked', 'photo_url')
            ->orderBy('id', 'asc')
            ->orderBy('name', 'asc')
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

        return redirect()->back();
    }

    // EDIT
    public function editA(User $user)
    {
        $tipo = $user->tipo;
        return view('users.admins.edit')
            ->withUser($user)
            ->withTipo($tipo);
    }

    public function editC(User $user)
    {
        $tipo = $user->tipo;
        return view('users.clientes.edit')
            ->withUser($user)
            ->withTipo($tipo);
    }

    public function editE(User $user)
    {
        $tipo = $user->tipo;
        return view('users.empregados.edit')
            ->withUser($user)
            ->withTipo($tipo);
    }


    // CREATE
    public function createA(User $user)
    {

        $user = new User;
        $user_type = $user->user_type = 'A';
        return view('users.admins.create')
            ->withUser($user)
            ->withTipo($user_type);

    }

    public function createC(User $user)

    {
        $user = new User;
        $user_type = $user->user_type = 'C';
        return view('users.clientes.create')
            ->withUser($user)
            ->withTipo($user_type);
    }

    public function createE(User $user)
    {
        $user = new User;
        $user_type = $user->user_type = 'E';
        return view('users.empregados.create')
            ->withUser($user)
            ->withTipo($user_type);
    }

//    // STORE
    public function storeA(UserPost $request)
    {
        $validated_data = $request->validated();
        User::create($validated_data);
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'Utilizador(a) "' . $validated_data['nome'] . '" foi criado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function storeC(UserPost $request)
    {
        $validated_data = $request->validated();
        User::create($validated_data);
        return redirect()->route('users.clientes.index')
            ->with('alert-msg', 'Utilizador(a) "' . $validated_data['nome'] . '" foi criado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function storeE(UserPost $request)
    {
        $validated_data = $request->validated();
        User::create($validated_data);
        return redirect()->route('users.empregados.index')
            ->with('alert-msg', 'Utilizador(a) "' . $validated_data['nome'] . '" foi criado(a) com sucesso!')
            ->with('alert-type', 'success');
    }


//    //UPDATE
    public function updateA(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->fill($validated_data);
        $user->save();
        return redirect()->route('users.admins.index')
            ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi alterado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function updateE(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->fill($validated_data);
        $user->save();
        return redirect()->route('users.empregados.index')
            ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi alterado(a) com sucesso!')
            ->with('alert-type', 'success');
    }

    public function updateC(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->fill($validated_data);
        $user->save();
        return redirect()->route('users.clientes.index')
            ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi alterado(a) com sucesso!')
            ->with('alert-type', 'success');
    }
//
//    // DESTROY
    public function destroyA(User $user, $id)
    {
        $oldName = $user->name;
        try {
            $user->delete();
            return redirect()->route('users.admins.index', ['id' => $id])
                ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi apagado(a) com sucesso!')
                ->with('alert-type', 'success');
        } catch (PDOException $th) {
            // $th is the exception thrown by the system - usually, the error occurs in the MySQL database server
            // Uncomment the next line to check the information available in the exception
            // dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.admins.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('users.admins.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function destroyE(User $user, $id)
    {
        $oldName = $user->name;
        try {
            $user->delete();
            return redirect()->route('users.empregados.index', ['id' => $id])
                ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi apagado(a) com sucesso!')
                ->with('alert-type', 'success');
        } catch (PDOException $th) {
            // $th is the exception thrown by the system - usually, the error occurs in the MySQL database server
            // Uncomment the next line to check the information available in the exception
            // dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.empregados.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('users.empregados.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function destroyC(User $user, $id)
    {
        $oldName = $user->name;
        try {
            $user->delete();
            return redirect()->route('users.clientes.index', ['id' => $id])
                ->with('alert-msg', 'Utilizador(a) "' . $user->name . '" foi apagado(a) com sucesso!')
                ->with('alert-type', 'success');
        } catch (PDOException $th) {
            // $th is the exception thrown by the system - usually, the error occurs in the MySQL database server
            // Uncomment the next line to check the information available in the exception
            // dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.clientes.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('users.clientes.index', ['id' => $id])
                    ->with('alert-msg', 'Não foi possível apagar o/a utilizador(a) "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function destroy_fotoA(User $user)
    {
        Storage::delete('public/photos/' . $user->photo_url);
        $user->photo_url = null;
        $user->save();
        return redirect()->route('users.admins.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do User "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function destroy_fotoE(User $user)
    {
        Storage::delete('public/photos/' . $user->photo_url);
        $user->photo_url = null;
        $user->save();
        return redirect()->route('users.empregados.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do User "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function destroy_fotoC(User $user)
    {
        Storage::delete('public/photos/' . $user->photo_url);
        $user->photo_url = null;
        $user->save();
        return redirect()->route('users.clientes.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do User "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

}
