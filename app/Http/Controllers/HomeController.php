<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        return view('home', compact('totalUsers'));
    }
} 