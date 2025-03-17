<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::orderBy('date', 'desc')->get();
        $totalIncomes = $incomes->sum('amount');
        return view('incomes.index', compact('incomes', 'totalIncomes'));
    }
}
