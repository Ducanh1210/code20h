<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobDescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = JobDescription::query();

        if (Auth::user()->role === 'employer') {
            $query->where('employer_id', Auth::id());
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('domain')) {
            $query->where('domain', 'like', '%' . $request->domain . '%');
        }

        $jds = $query->latest()->paginate(9);

        return view('client.jobs', compact('jds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'title'        => 'required|string|max:255',
            'domain'       => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits'     => 'nullable|string',
        ]);

        $validated['employer_id'] = Auth::id();

        JobDescription::create($validated);

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được lưu thành công.');
    }

    public function update(Request $request, JobDescription $jd)
    {
        $this->authorizeEmployer($jd);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'title'        => 'required|string|max:255',
            'domain'       => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits'     => 'nullable|string',
        ]);

        $jd->update($validated);

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được cập nhật.');
    }

    public function destroy(JobDescription $jd)
    {
        $this->authorizeEmployer($jd);
        $jd->delete();

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được xóa.');
    }

    protected function authorizeEmployer(JobDescription $jd)
    {
        if (Auth::user()->role !== 'employer' && Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        if (Auth::user()->role === 'employer' && $jd->employer_id !== Auth::id()) {
            abort(403, 'Bạn không sở hữu bản mô tả công việc này.');
        }
    }

    public function generateQuestions(Request $request, JobDescription $jd, \App\Services\OpenRouterService $ai)
    {
        // Convert JD to text
        $jdText = \App\Services\OpenRouterService::jdToText($jd);

        // Call AI service
        $result = $ai->generateInterviewQuestions($jdText);

        if (isset($result['error'])) {
            return response()->json(['success' => false, 'error' => $result['error']], 500);
        }

        // Save result directly to JSON column
        $jd->update([
            'interview_questions' => $result
        ]);

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }
}
