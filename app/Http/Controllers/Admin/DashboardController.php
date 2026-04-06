<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $recentUsers = User::where('role', 'user')->orderBy('created_at', 'desc')->take(5)->get();
        $adminCount = User::where('role', 'admin')->count();

        return view('dashboard', compact('totalUsers', 'recentUsers', 'adminCount'));
    }
}
