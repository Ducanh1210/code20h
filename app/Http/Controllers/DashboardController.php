<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\JobDescription;
use App\Models\CvJobMatch;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cvCount = Cv::where('user_id', $user->id)->count();
        $jdCount = JobDescription::where('employer_id', $user->id)->count();
        $analysisCount = CvJobMatch::whereHas('cv', fn($q) => $q->where('user_id', $user->id))->count();

        $recentCvs = Cv::where('user_id', $user->id)
            ->latest()
            ->take(4)
            ->get();

        $recentJds = JobDescription::where('employer_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        $recentMatches = CvJobMatch::whereHas('cv', fn($q) => $q->where('user_id', $user->id))
            ->with(['cv', 'jobDescription'])
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'cvCount',
            'jdCount',
            'analysisCount',
            'recentCvs',
            'recentJds',
            'recentMatches'
        ));
    }
}
