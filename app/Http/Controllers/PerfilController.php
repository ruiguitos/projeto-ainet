<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $user->id . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);

            $user->photo_url = $filename;
            $user->save();
        }

        return redirect()->back();
    }

    public function edit(User $User)
    {
        return view('perfil.edit');
    }

    public function create(User $User)
    {
        return view('perfil.create');

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
        } catch (Throwable $th) {
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
