<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('date', 'desc')->get();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $systemCategories = Category::where('is_system', true)->get();
        //preciso pegar as categorias do usuário logado
        $userCategories = User::find(Auth::id())->categories()->get();
        $categories = $systemCategories->merge($userCategories);
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Substitui a vírgula por ponto para garantir que a validação numérica funcione corretamente
        $request->merge(['amount' => str_replace(',', '.', $request->input('amount'))]);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $expense = Expense::create([
            'user_id' => Auth::id(),  // Adiciona o ID do usuário logado
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('expenses.index')->with('status', 'Despesa criada com sucesso');
    }
}
