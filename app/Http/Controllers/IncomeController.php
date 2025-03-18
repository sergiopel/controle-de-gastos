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
        $incomes = User::find(Auth::id())->incomes()->orderBy('date', 'desc')->get();
        $totalIncomes = $incomes->sum('amount');
        return view('incomes.index', compact('incomes', 'totalIncomes'));
    }

    public function create()
    {
        $userCategories = User::find(Auth::id())->categories()->where('type', 'income')->get();
        $systemCategories = Category::where('is_system', true)->where('type', 'income')->get();
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

    public function edit(Income $income)
    {
        $userCategories = User::find(Auth::id())->categories()->where('type', 'income')->get();
        $systemCategories = Category::where('is_system', true)->where('type', 'income')->get();
        $categories = $userCategories->merge($systemCategories);
        return view('incomes.edit', compact('income', 'categories'));   
    }

    public function update(Request $request, Income $income)
    {
        //pegar campo amount da tela e formatar para o padrão do banco de dados
        // Remove pontos do valor recebido e atribui o valor sem pontos para a variável $amount
        $amount = str_replace('.', '', $request->input('amount'));
        // Atualiza o valor do campo 'amount' na requisição com o valor da variável $amount (sem os pontos)
        $request->merge(['amount' => $amount]);
        
        // Esta linha está atualizando o valor do campo 'amount' dentro do objeto $request.
        // $request é uma variável que contém os dados da requisição HTTP.
        // 'amount' é o campo que está sendo modificado.
        // A função str_replace(',', '.', $request->input('amount')) substitui todas as vírgulas por pontos no valor original do campo 'amount'.
        $request->merge(['amount' => str_replace(',', '.', $request->input('amount'))]);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $income->update($request->all());

        return redirect()->route('incomes.index')->with('status', 'Receita atualizada com sucesso');        
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')->with('status', 'Receita excluída com sucesso');
    }
}
