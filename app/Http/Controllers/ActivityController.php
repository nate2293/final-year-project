<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Optional safety check (keep if you want "students only")
        if (!$user->role) {
            abort(403, 'No student profile found for this user.');
        }

        $activities = Activity::where('user_id', $user->id)
            ->orderByDesc('application_date')
            ->orderByDesc('created_at')
            ->get();

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->role) {
            abort(403, 'No student profile found for this user.');
        }

        $validated = $request->validate([
            'activity_type' => 'required|string|in:application,interview,follow_up,offer,rejection,assessment,networking',
            'company_name' => 'nullable|string|max:255',
            'role_title' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,reviewing,shortlisted,rejected,accepted',
            'application_date' => 'nullable|date',
            'interview_date' => 'nullable|date',
            'follow_up_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'evidence_link' => 'nullable|url|max:255', // slightly better than "string"
            'cover_letter' => 'nullable|string',
        ]);

        // Force ownership (never trust the form for this)
        $validated['user_id'] = $user->id;

        Activity::create($validated);

        return redirect()
            ->route('activities.index')
            ->with('success', 'Engagement entry added successfully.');
    }

    public function edit(Activity $application)
    {
        $user = Auth::user();

        if (!$user->role || $application->user_id !== $user->id) {
            abort(403);
        }

        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $application)
    {
        $user = Auth::user();

        if (!$user->role || $application->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'activity_type' => 'required|string|in:application,interview,follow_up,offer,rejection,assessment,networking',
            'company_name' => 'nullable|string|max:255',
            'role_title' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,reviewing,shortlisted,rejected,accepted',
            'application_date' => 'nullable|date',
            'interview_date' => 'nullable|date',
            'follow_up_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'evidence_link' => 'nullable|url|max:255',
            'cover_letter' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()
            ->route('activities.index')
            ->with('success', 'Engagement entry updated successfully.');
    }

    public function destroy(Activity $application)
    {
        $user = Auth::user();

        if (!$user->role || $application->user_id !== $user->id) {
            abort(403);
        }

        $application->delete();

        return redirect()
            ->route('activities.index')
            ->with('success', 'Engagement entry deleted.');
    }
}
