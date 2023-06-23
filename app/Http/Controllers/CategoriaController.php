<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categories = Categoria::select('id','name')
            ->orderBy('name','asc')
            ->paginate(15);
        return view('categorias.index', compact('categories'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Categoria::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categorias.index')->with('success', 'Category created successfully.');
    }

    public function edit(Categoria $category)
    {
        return view('categorias.edit', compact('category'));
    }

    public function update(Request $request, Categoria $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categorias.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categoria $category)
    {
        $category->delete();
        return redirect()->route('categorias.index')->with('success', 'Category deleted successfully.');
    }
}
