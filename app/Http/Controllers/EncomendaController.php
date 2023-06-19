<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Imagem;
use App\Models\Preco;
use App\Models\TShirt;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index()
    {
        $orders = Encomenda::select('id', 'status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url')->paginate(100);
        $order_items = Encomenda::all();




        return view('encomendas.index', compact('orders', 'order_items'));
    }


    public function edit(Order $Order)
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
        } catch (\Throwable $th) {
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
