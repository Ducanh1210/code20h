<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\User;
use App\Models\Cv;
use App\Models\JobDescription;
use Illuminate\Http\Request;

=======
use Illuminate\Http\Request;

use App\Models\User;

>>>>>>> 14ee4e5678a0a7c7bfd39895dec67b34ad98870c
class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $stats = [
            'total_users' => User::count(),
            'total_cvs' => Cv::count(),
            'total_jobs' => JobDescription::count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
        ];

        return view('admin.dashboard', compact('stats'));
=======
        $totalUsers = User::count();
        $recentUsers = User::where('role', 'user')->orderBy('created_at', 'desc')->take(5)->get();
        $adminCount = User::where('role', 'admin')->count();

        return view('dashboard', compact('totalUsers', 'recentUsers', 'adminCount'));
>>>>>>> 14ee4e5678a0a7c7bfd39895dec67b34ad98870c
    }
}
