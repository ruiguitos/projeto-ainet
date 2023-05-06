<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function admin_index(Request $request)
    {
        $qry = User::wherein('tipo', ['A', 'F']);
        $users = $qry->paginate(14);

        return view('users.admin')
            ->withUsers($users);
    }

    public function ativar(User $user)
    {
        $userId = $user->id;
        try {
            $user->bloqueado = false;
            $user->save();
            return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $userId . '" Ativado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            return redirect()->route('admin.users')
                ->with('alert-msg', 'Não foi possível ativar o User' . $userId)
                ->with('alert-type', 'danger');
        }

    }
    public function desativar(User $user)
    {
        $userId = $user->id;
        try {
            $user->bloqueado = true;
            $user->save();
            return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $userId . '" desativado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            return redirect()->route('admin.users')
                ->with('alert-msg', 'Não foi possível desativar o User')
                ->with('alert-type', 'danger');
        }
    }

    public function create()
    {
        $user = new User;
        $user_type = $user->user_type = 'A';
        return view('users.create')
            ->withUser($user)
            ->withTipo($user_type);
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->user_type = $validated_data['user_type'];
        $newUser->password = Hash::make('123');
        if ($request->hasFile('photo_url')) {
            $path = $request->photo_url->store('public/photos');
            $newUser->photo_url = basename($path);
        }
        $newUser->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function edit(User $user)
    {
        $user_type = $user->user_type;
        return view('users.edit')
            ->withUser($user)
            ->withTipo($user_type);
    }

    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->email = $validated_data['email'];
        $user->name = $validated_data['name'];
        $user->user_type = $validated_data['user_type'];
        if ($request->hasFile('photo_url')) {
            Storage::delete('public/photos/' . $user->photo_url);
            $path = $request->foto_url->store('public/photos');
            $user->photo_url = basename($path);
        }
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $user)
    {
        $oldName = $user->name;
        $oldUrlPhoto = $user->photo_url;
        try {
            $user->delete();
            Storage::delete('public/photos/' . $oldUrlPhoto);
            return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $user->name . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            return redirect()->route('admin.users')
                ->with('alert-msg', 'Não foi possível apagar o User "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                ->with('alert-type', 'danger');
        }
    }

    public function destroy_foto(User $user)
    {
        Storage::delete('public/photos/' . $user->photo_url);
        $user->photo_url = null;
        $user->save();
        return redirect()->route('admin.users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do User "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
