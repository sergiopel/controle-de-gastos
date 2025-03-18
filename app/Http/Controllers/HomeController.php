<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalExpenses = Expense::sum('amount');
        $totalExpenses = number_format($totalExpenses, 2, ',', '.');

        $totalIncomes = Income::sum('amount');
        $totalIncomes = number_format($totalIncomes, 2, ',', '.');

        $saldo = (float)str_replace(',', '.', str_replace('.', '', $totalIncomes)) - (float)str_replace(',', '.', str_replace('.', '', $totalExpenses));
        $saldo = number_format($saldo, 2, ',', '.');

        $expensesByCategory = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->selectRaw('SUM(expenses.amount) as total_expenses')
            ->groupBy('categories.name')
            ->pluck('total_expenses', 'categories.name')
            ->toArray();

        $incomesByCategory = Income::join('categories', 'incomes.category_id', '=', 'categories.id')
            ->where('incomes.user_id', Auth::id())
            ->select('categories.name')
            ->selectRaw('SUM(incomes.amount) as total_incomes')
            ->groupBy('categories.name')
            ->pluck('total_incomes', 'categories.name')
            ->toArray();

        return view('home', compact('totalUsers', 'totalExpenses', 'totalIncomes', 'saldo', 'expensesByCategory', 'incomesByCategory'));
    }
}
