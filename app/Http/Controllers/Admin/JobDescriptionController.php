<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobDescription;
use App\Models\User;
use Illuminate\Http\Request;

class JobDescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = JobDescription::with('employer');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('domain', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('employer_id')) {
            $query->where('employer_id', $request->employer_id);
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        $domains = JobDescription::whereNotNull('domain')->distinct()->pluck('domain');
        $employers = User::whereIn('role', ['employer', 'admin'])->get();

        return view('admin.jobs.index', compact('jobs', 'domains', 'employers'));
    }

    public function create()
    {
        $employers = User::whereIn('role', ['employer', 'admin'])->get();
        return view('admin.jobs.create', compact('employers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'employer_id' => ['required', 'exists:users,id'],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'domain' => ['nullable', 'string', 'max:255'],
        ]);

        JobDescription::create([
            'title' => $request->title,
            'employer_id' => $request->employer_id,
            'description' => $request->description,
            'requirements' => $request->requirements ? array_map('trim', explode("\n", $request->requirements)) : null,
            'domain' => $request->domain,
        ]);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Đã tạo Job Description mới thành công!');
    }

    public function show(string $id)
    {
        $job = JobDescription::with('employer')->findOrFail($id);
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(string $id)
    {
        $job = JobDescription::findOrFail($id);
        $employers = User::whereIn('role', ['employer', 'admin'])->get();
        return view('admin.jobs.edit', compact('job', 'employers'));
    }

    public function update(Request $request, string $id)
    {
        $job = JobDescription::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'employer_id' => ['required', 'exists:users,id'],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'domain' => ['nullable', 'string', 'max:255'],
        ]);

        $job->update([
            'title' => $request->title,
            'employer_id' => $request->employer_id,
            'description' => $request->description,
            'requirements' => $request->requirements ? array_map('trim', explode("\n", $request->requirements)) : null,
            'domain' => $request->domain,
        ]);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Đã cập nhật Job Description thành công!');
    }

    public function destroy(string $id)
    {
        $job = JobDescription::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Đã xóa Job Description thành công!');
    }
}
