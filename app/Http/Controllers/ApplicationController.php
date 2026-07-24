<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ApplicationController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;

        $applications = $student->activities()
            ->with([
                'opportunity.company',
                'opportunity.activities',
            ])
            ->where('activity_type', \App\Enums\ActivityType::Application)
            ->orderBy('activity_date', 'desc')
            ->paginate(6);

        // dd(\App\Enums\ActivityType::options());


        $activityOptions = \App\Enums\ActivityType::options();

        return view('applications.index', compact('applications', 'activityOptions'));
    }


    public function show(Activity $activity)
    {
        return view('applications.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('applications.edit', compact('activity'));
    }

    // public function update(Request $request, Activity $activity)
    // {
    //     $data = $request->validate([
    //         'activity_type' => ['required', new Enum(ActivityType::class)],
    //     ]);

    //     $activity->update($data);

    //     return redirect()->route('applications.index');
    // }
}
