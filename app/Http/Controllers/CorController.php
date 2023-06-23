<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorPost;
use App\Models\Cor;

class CorController
{

   public function index()
   {
       $colors = Cor::select('name', 'code')
           ->orderBy('name','asc')
           ->orderBy('code','asc')
           ->paginate(10);

       return view('cores.index', compact('colors'));
    }


    public function edit(Cor $Cor)
    {
        return view('cores.edit')
            ->withCor($Cor);
    }

    public function create(Cor $Cor)
    {
        return view('cores.create')
            ->withCor($Cor);
    }

    public function store(CorPost $request)
    {
        $validated_data = $request->validated();
        Cor::create($validated_data);
        return redirect()->route('cores.index')
            ->with('alert-msg', 'Cor "' . $validated_data['nome'] . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(CorPost $request, Cor $Cor)
    {
        $validated_data = $request->validated();
        $Cor->fill($validated_data);
        $Cor->save();
        return redirect()->route('cores.index')
            ->with('alert-msg', 'Cor "' . $Cor->name . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cor $Cor)
    {
        $oldName = $Cor->nome;
        try {
            $Cor->delete();
            return redirect()->route('cores.index')
                ->with('alert-msg', 'Cor "' . $Cor->name . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('generos.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Cor"' . $oldName . '", porque está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('generos.admin')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

}
