<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cv;
use App\Models\JobDescription;
use App\Models\CvJobMatch;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $stats = [
            'total_users'       => User::count(),
            'active_users'      => User::where('is_active', true)->count(),
            'locked_users'      => User::where('is_active', false)->count(),
            'admin_count'       => User::where('role', 'admin')->count(),
            'employer_count'    => User::where('role', 'employer')->count(),
            'candidate_count'   => User::where('role', 'candidate')->count(),
            'new_users_today'   => User::whereDate('created_at', today())->count(),
            'new_users_week'    => User::where('created_at', '>=', $now->copy()->subDays(7))->count(),
            'total_cvs'         => Cv::count(),
            'total_jds'         => JobDescription::count(),
            'total_analyses'    => CvJobMatch::count(),
        ];

        // Users registered per day (last 7 days)
        $usersByDay = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $usersByDay[] = [
                'label' => $date->format('d/m'),
                'count' => User::whereDate('created_at', $date->toDateString())->count(),
            ];
        }

        $recentUsers = User::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'usersByDay'));
    }
}
