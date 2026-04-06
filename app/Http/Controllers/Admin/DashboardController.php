<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cv;
use App\Models\JobDescription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_cvs' => Cv::count(),
            'total_jobs' => JobDescription::count(),
            'admin_count' => User::where('role', 'admin')->count(),
            'employer_count' => User::where('role', 'employer')->count(),
            'candidate_count' => User::where('role', 'candidate')->count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
        ];

        // Fetch recent activities or users if needed for the view
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }
}
