<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class EncomendaController extends Controller
{
    public function index()
    {
        $orders = Encomenda::select('id', 'status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url')->paginate(20);
        $order_items = Encomenda::all();

        return view('encomendas.index', compact('orders', 'order_items'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $orders = Encomenda::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'canceled' || $status === 'closed') {
            $orders->status = $status;
            $orders->save();

//            return redirect()->route('encomendas.index')->with('success', 'Status atualizado com sucesso.');
        }
                return redirect()->back();

    }

//    public function toggleStatus(Request $request, $id)
//    {
//        $users = User::findOrFail($id);
//        $users->blocked = !$users->blocked;
//        $users->save();
//
//        // Redirect or return response as needed
//        return redirect()->back();
//    }


    public function encomendaTshirt(): View
    {
        $users = Encomenda::select('orders.id', 'orders.status', 'orders.customer_id', 'orders.date', 'orders.total_price', 'orders.notes', 'orders.nif', 'orders.address', 'orders.payment_type', 'orders.payment_ref', 'orders.receipt_url',
            'order_items.id', 'order_items.order_id', 'order_items.tshirt_image_id', 'order_items.color_code', 'order_items.size', 'order_items.qty', 'order_items.unit_price', 'order_items.sub_total')
            ->join('order_items', 'order.id', '=', 'order_items.order_id')
            ->where('users.user_type', 'C');

        return view('perfil.index', compact('users'));
    }

    public function edit(Encomenda $Order)
    {
        return view('encomendas.edit')
            ->withEncomenda($Order);
    }

    public function create(Encomenda $Order)
    {
        return view('encomendas.create')
            ->withEncomenda($Order);
    }

    public function store(EncomendaPost $request)
    {
        $validated_data = $request->validated();
        Encomenda::create($validated_data);
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Encomenda "' . $validated_data['nome'] . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(EncomendaPost $request, Encomenda $Order)
    {
        $validated_data = $request->validated();
        $Order->fill($validated_data);
        $Order->save();
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Encomenda "' . $Order->name . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Encomenda $Order)
    {
        $oldName = $Order->nome;
        try {
            $Order->delete();
            return redirect()->route('encomendas.index')
                ->with('alert-msg', 'Encomenda "' . $Order->name . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro oEncomendare no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('generos.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda"' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('generos.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
