<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobDescriptionController extends Controller
{
    /**
     * Display a listing of Job Descriptions.
     */
    public function index(Request $request)
    {
        $query = JobDescription::query();

        // For employers, show their own. For others (admin/candidate), show all.
        if (Auth::user()->role === 'employer') {
            $query->where('employer_id', Auth::id());
        }

        // Search by Title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by Domain
        if ($request->filled('domain')) {
            $query->where('domain', 'like', '%' . $request->domain . '%');
        }

        $jds = $query->latest()->paginate(9);

        return view('client.jobs', compact('jds'));
    }

    /**
     * Store a newly created Job Description.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'domain' => 'nullable|string|max:100',
        ]);

        JobDescription::create([
            'employer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => explode("\n", $request->requirements), // Basic parsing
            'domain' => $request->domain,
        ]);

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được lưu.');
    }

    /**
     * Update an existing Job Description.
     */
    public function update(Request $request, JobDescription $jd)
    {
        $this->authorizeEmployer($jd);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'domain' => 'nullable|string|max:100',
        ]);

        $jd->update([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => explode("\n", $request->requirements),
            'domain' => $request->domain,
        ]);

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được cập nhật.');
    }

    /**
     * Remove the specified Job Description.
     */
    public function destroy(JobDescription $jd)
    {
        $this->authorizeEmployer($jd);
        $jd->delete();

        return redirect()->route('client.jobs')->with('success', 'Mô tả công việc đã được xóa.');
    }

    /**
     * Ensure the logged-in user is an employer and owns the JD.
     */
    protected function authorizeEmployer(JobDescription $jd)
    {
        if (Auth::user()->role !== 'employer' && Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        if (Auth::user()->role === 'employer' && $jd->employer_id !== Auth::id()) {
            abort(403, 'Bạn không sở hữu bản mô tả công việc này.');
        }
    }
}
