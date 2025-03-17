<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::orderBy('date', 'desc')->get();
        $totalIncomes = $incomes->sum('amount');
        return view('incomes.index', compact('incomes', 'totalIncomes'));
    }

    public function create()
    {
        $userCategories = User::find(Auth::id())->categories()->get();
        $systemCategories = Category::where('is_system', true)->get();
        $categories = $userCategories->merge($systemCategories);
        return view('incomes.create', compact('categories'));
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

        $income = Income::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('incomes.index')->with('status', 'Receita criada com sucesso');
    }
}
