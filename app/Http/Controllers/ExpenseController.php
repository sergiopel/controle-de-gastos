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
        $expenses = User::find(Auth::id())->expenses()->orderBy('date', 'desc')->get();
        $totalExpenses = $expenses->sum('amount');
        return view('expenses.index', compact('expenses', 'totalExpenses'));
    }

    public function create()
    {
        $systemCategories = Category::where('is_system', true)->where('type', 'expense')->get();
        //preciso pegar as categorias do usuário logado
        $userCategories = User::find(Auth::id())->categories()->where('type', 'expense')->get();
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

    public function edit(Expense $expense)
    {
        $expense = Expense::find($expense->id);
        $systemCategories = Category::where('is_system', true)->where('type', 'expense')->get();
        $userCategories = User::find(Auth::id())->categories()->where('type', 'expense')->get();
        $categories = $systemCategories->merge($userCategories);
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $expense = Expense::find($expense->id);
        $amount = str_replace('.', '', $request->input('amount'));
        $request->merge(['amount' => str_replace(',', '.', $amount)]);
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('status', 'Despesa atualizada com sucesso');
    }
    
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('status', 'Despesa excluída com sucesso');
    }
}
