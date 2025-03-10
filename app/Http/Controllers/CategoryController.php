<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            // Validação do campo 'type':
            // - required: campo obrigatório
            // - string: deve ser uma string
            // - in:income,expense: valor deve ser 'income' ou 'expense' apenas
            'type' => 'required|string|in:income,expense',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index')->with('status', 'Categoria criada com sucesso');
    }

    public function edit(Category $category)
    {
        $category = Category::find($category->id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'type' => 'required|string|in:income,expense',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index')->with('status', 'Categoria atualizada com sucesso');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Categoria excluída com sucesso');
    }
}
