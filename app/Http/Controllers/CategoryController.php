<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Busca todas as categorias que são de sistema
        $systemCategories = Category::where('is_system', true)->get();
        
        // Busca categorias específicas para o usuário autenticado
        $userCategories = User::find(Auth::id())->categories()->get();

        // Combina as categorias de sistema com as do usuário
        $categories = $systemCategories->merge($userCategories);

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

        $category = Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'is_system' => false
        ]);
        
        // Usando o modelo User diretamente
        // Busca o usuário autenticado pelo ID usando User::find() e Auth::id()
        // Em seguida, acessa o relacionamento categories() definido no modelo User
        // Por fim, usa o método attach() para criar um registro na tabela pivot category_user
        // vinculando a categoria recém-criada ao usuário atual
        User::find(Auth::id())->categories()->attach($category->id);
        
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
