<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        $totalExpenses = Expense::sum('amount');
        $totalExpenses = number_format($totalExpenses, 2, ',', '.');
        
        $totalIncomes = Income::sum('amount');
        $totalIncomes = number_format($totalIncomes, 2, ',', '.');
        
        return view('home', compact('totalUsers', 'totalExpenses', 'totalIncomes'));
    }
} 