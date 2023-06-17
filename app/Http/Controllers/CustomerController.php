<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientePost;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::select('id', 'nif', 'address', 'default_payment_type', 'default_payment_ref');
        $users = User::select('id','name','email','user_type','blocked','photo_url');

        return view('clientes.index')
            ->withCustomers($customers)
            ->withCustomers($users);
    }
//    public function ativar(Customer $customer)
//    {
//        $customerId = $customer->id;
//        try {
//            $customer->userRef->bloqueado = false;
//            $customer->userRef->save();
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Cliente "' . $customerId . '" Ativado com sucesso!')
//                ->with('alert-type', 'success');
//        } catch (\Throwable $th) {
//
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Não foi possível ativar o Cliente' . $customerId)
//                ->with('alert-type', 'danger');
//        }
//
//    }
//    public function desativar(Customer $customer)
//    {
//        $customerId = $customer->id;
//        try {
//            $customer->userRef->bloqueado = true;
//            $customer->userRef->save();
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Cliente "' . $customerId . '" desativado com sucesso!')
//                ->with('alert-type', 'success');
//        } catch (\Throwable $th) {
//
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Não foi possível desativar o Cliente')
//                ->with('alert-type', 'danger');
//        }
//    }
//
//    public function index()
//    {
//        return view('perfil.index');
//    }
//
//    public function edit(Customer $customer)
//    {
//        return view('perfil.edit')
//            ->withCustomer($customer);
//    }
//
//    public function store(CustomerPost $request)
//    {
//        $validated_data = $request->validated();
//        $newUser = new User;
//        $newUser->email = $validated_data['email'];
//        $newUser->name = $validated_data['name'];
//        $newUser->password = Hash::make('123');
//        if ($request->hasFile('photo')) {
//            $path = $request->photo->store('public/photos');
//            $newUser->photo_url = basename($path);
//        }
//        $newUser->save();
//        $customer = new Customer;
//        $customer->id = $newUser->id;
//        $customer->nif = $validated_data['nif'];
//        $customer->address = $validated_data['address'];
//        $customer->payment_type = $validated_data['payment_type'];
//        $customer->payment_ref = $validated_data['payment_ref'];
//        $customer->save();
//        return redirect()->route('perfil.index', $customer)
//            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
//            ->with('alert-type', 'success');
//    }
//
//    public function update(CustomerPost $request, Customer $customer)
//    {
//        $validated_data = $request->validated();
//        $customer->userRef->email = $validated_data['email'];
//        $customer->userRef->name = $validated_data['name'];
//        if ($request->hasFile('photo')) {
//            Storage::delete('public/photos/' . $customer->userRef->photo_url); //goto_url
//            $path = $request->foto->store('public/photos');
//            $customer->userRef->photo_url = basename($path);
//        }
//        $customer->userRef->save();
//        $customer->nif = $validated_data['nif'];
//        $customer->address = $validated_data['address'];
//        $customer->payment_type = $validated_data['payment_type'];
//        $customer->payment_ref = $validated_data['payment_ref'];
//        $customer->save();
//        return redirect()->route('perfil.index', $customer)
//            ->with('alert-msg', 'Cliente "' . $customer->userRef->name . '" foi alterado com sucesso!')
//            ->with('alert-type', 'success');
//    }
//
//    public function destroy_foto(Customer $customer)
//    {
//        Storage::delete('public/photos/' . $customer->userRef->photo_url);
//        $customer->userRef->photo_url = null;
//        $customer->userRef->save();
//        return redirect()->route('perfil.edit', ['cliente' => $customer])
//            ->with('alert-msg', 'Foto do cliente "' . $customer->userRef->name . '" foi removida!')
//            ->with('alert-type', 'success');
//    }
//
//    public function destroy(Customer $customer)
//    {
//        $oldName = $customer->userRef->name;
//        $oldUserID = $customer->userRef->id;
//        $oldUrlPhoto = $customer->userRef->photo_url;
//        try {
//            $customer->delete();
//            User::destroy($oldUserID);
//            Storage::delete('public/photos/' . $oldUrlPhoto);
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Aluno "' . $customer->userRef->name . '" foi apagado com sucesso!')
//                ->with('alert-type', 'success');
//        } catch (\Throwable $th) {
//            return redirect()->route('admin.clientes')
//                ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '". Erro: ' . $th->errorInfo[2])
//                ->with('alert-type', 'danger');
//        }
//    }

}
