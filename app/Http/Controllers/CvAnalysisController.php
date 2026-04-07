<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\CvJobMatch;
use App\Models\JobDescription;
use App\Services\OpenRouterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvAnalysisController extends Controller
{
    protected OpenRouterService $ai;

    public function __construct(OpenRouterService $ai)
    {
        $this->ai = $ai;
    }

    /**
     * Show the AI Analysis page with user's CVs, JDs, and history.
     */
    public function index()
    {
        $cvs = Cv::where('user_id', Auth::id())->latest()->get();
        $jds = JobDescription::latest()->get();
        $history = CvJobMatch::with(['cv', 'jobDescription'])
            ->whereHas('cv', fn($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->limit(10)
            ->get();

        return view('client.ai-analysis', compact('cvs', 'jds', 'history'));
    }

    /**
     * Run AI comparison between a CV and a JD.
     */
    public function compare(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'jd_id' => 'required|exists:job_descriptions,id',
        ]);

        $cv = Cv::where('user_id', Auth::id())->findOrFail($request->cv_id);
        $jd = JobDescription::findOrFail($request->jd_id);

        // Convert to readable text
        $cvText = OpenRouterService::cvContentToText($cv->content ?? []);
        $jdText = OpenRouterService::jdToText($jd);

        if (empty(trim($cvText))) {
            return response()->json(['error' => 'CV chưa có nội dung. Hãy vào CV Builder để nhập thông tin.'], 422);
        }

        // Call AI
        $result = $this->ai->compareCvWithJd($cvText, $jdText);

        if (isset($result['error'])) {
            return response()->json(['error' => 'AI không thể phân tích: ' . $result['error']], 500);
        }

        // Save to database
        $match = CvJobMatch::updateOrCreate(
            ['cv_id' => $cv->id, 'job_description_id' => $jd->id],
            [
                'match_score' => $result['match_score'] ?? 0,
                'strengths' => $result['strengths'] ?? [],
                'missing_skills' => $result['missing_skills'] ?? [],
                'improvement_suggestions' => $result['improvement_suggestions'] ?? [],
                'analysis_data' => $result,
                'roadmap' => $result['roadmap'] ?? [],
            ]
        );

        return response()->json([
            'success' => true,
            'match_id' => $match->id,
            'data' => $result,
        ]);
    }

    /**
     * Run AI analysis on a single CV (no JD needed).
     */
    public function analyzeCv(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
        ]);

        $cv = Cv::where('user_id', Auth::id())->findOrFail($request->cv_id);
        $cvText = OpenRouterService::cvContentToText($cv->content ?? []);

        if (empty(trim($cvText))) {
            return response()->json(['error' => 'CV chưa có nội dung.'], 422);
        }

        $result = $this->ai->analyzeCv($cvText);

        if (isset($result['error'])) {
            return response()->json(['error' => 'AI không thể phân tích: ' . $result['error']], 500);
        }

        // Save extracted data back to the CV
        $cv->extracted_skills = $result['skills'] ?? null;
        $cv->extracted_experience = $result['experience'] ?? null;
        $cv->save();

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    /**
     * Show the dynamic Roadmap page.
     */
    public function roadmap()
    {
        $jds = JobDescription::latest()->get();
        // Also fetch the most recently compared JD if any
        $lastMatch = CvJobMatch::whereHas('cv', fn($q) => $q->where('user_id', Auth::id()))
            ->with('jobDescription')
            ->latest()
            ->first();

        return view('client.roadmap', compact('jds', 'lastMatch'));
    }

    /**
     * Get roadmap JSON for a specific JD and the user's latest CV.
     */
    public function getRoadmap(JobDescription $jd)
    {
        $cv = Cv::where('user_id', Auth::id())->latest()->first();

        if (!$cv) {
            return response()->json(['error' => 'Bạn chưa có CV nào. Hãy tạo CV để xem lộ trình.'], 404);
        }

        $match = CvJobMatch::where('cv_id', $cv->id)
            ->where('job_description_id', $jd->id)
            ->first();

        if (!$match || !$match->roadmap) {
            return response()->json([
                'error' => 'Chưa có phân tích lộ trình cho JD này.',
                'needs_analysis' => true,
                'cv_id' => $cv->id,
                'jd_id' => $jd->id
            ], 404);
        }

        return response()->json([
            'success' => true,
            'roadmap' => $match->roadmap,
            'match_score' => $match->match_score,
            'company_name' => $jd->company_name,
            'job_title' => $jd->title,
            'cv_id' => $match->cv_id ?? $cv->id,
            'jd_id' => $jd->id,
        ]);
    }
}
