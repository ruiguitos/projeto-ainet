<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Imagem;
use App\Models\Preco;
use App\Models\TShirt;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EncomendaController extends Controller
{
    public function index()
    {
        $orders = Encomenda::select('id', 'status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url')->paginate(20);
        $order_items = Encomenda::all();

        return view('encomendas.index', compact('orders', 'order_items'));
    }

    public function encomendaTshirt(): View
    {
        $users = Encomenda::select('orders.id', 'orders.status', 'orders.customer_id', 'orders.date', 'orders.total_price', 'orders.notes', 'orders.nif', 'orders.address', 'orders.payment_type', 'orders.payment_ref', 'orders.receipt_url',
            'order_items.id', 'order_items.order_id', 'order_items.tshirt_image_id', 'order_items.color_code', 'order_items.size', 'order_items.qty', 'order_items.unit_price', 'order_items.sub_total')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('users.user_type', 'C');

        return view('perfil.index', compact('users'));
    }

        public function encomendaClientes()
    {
//        dd('aqui');
        $user = Auth::user();

        $encomendas = Encomenda::select('id', 'status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url')
//            ->where('customer_id', '$user->id')
            ->where('customer_id', $user->id)
            ->paginate(20);

        return view('encomendas.clientes', compact('encomendas'));
    }

    public function edit(Order $order)
    {
        return view('encomendas.edit')
            ->withEncomenda($order);
    }

    public function create(Encomenda $order)
    {
        return view('encomendas.create')
            ->withEncomenda($order);
    }

    public function store(EncomendaPost $request)
    {
        $validated_data = $request->validated();
        Encomenda::create($validated_data);
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Encomenda "' . $validated_data['nome'] . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(EncomendaPost $request, Encomenda $order)
    {
        $validated_data = $request->validated();
        $order->fill($validated_data);
        $order->save();
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Encomenda "' . $order->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Encomenda $order)
    {
        $oldName = $order->id;
        try {
            $order->delete();
            return redirect()->route('encomendas.index')
                ->with('alert-msg', 'Encomenda "' . $order->id . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro oEncomendare no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('encomendas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda"' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('encomendas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }



}
