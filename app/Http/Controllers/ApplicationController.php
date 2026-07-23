<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;

        $applications = $student->activities()
            ->with('opportunity.company')
            ->orderBy('activity_date', 'desc')
            ->get()
            ->unique('opportunity_id')
            ->values();

        return view('applications.index', compact('applications'));
    }

    public function show(Activity $activity)
    {
        return view('applications.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('applications.edit', compact('activity'));
    }
}
