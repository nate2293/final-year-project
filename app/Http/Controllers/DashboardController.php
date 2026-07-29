<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // added below
        $student = auth()->user()->student;
        // $recentApplications = Activity::with('opportunity.company')
        //     ->latest()
        //     ->take(3)
        //     ->get();
        $recentApplications = $student->activities()
            ->with('opportunity.company')
            ->latest('activity_date')
            ->take(3)
            ->get();

        $latestOpportunities = Opportunity::with([
            'company',
            'activities' => function ($query) {
                $query->latest('activity_date');
            },
        ])
            ->latest()
            ->take(3)
            ->get();

        // $applications = Activity::where('activity_type', ActivityType::Application)->count();

        // $interviews = Activity::where('activity_type', ActivityType::Interview)->count();

        // $assessments = Activity::where('activity_type', ActivityType::Assessment)->count();

        // $offers = Activity::where('activity_type', ActivityType::Offer)->count();

        $applications = $student->activities()
            ->where('activity_type', ActivityType::Application)
            ->count();

        $interviews = $student->activities()
            ->where('activity_type', ActivityType::Interview)
            ->count();

        $assessments = $student->activities()
            ->where('activity_type', ActivityType::Assessment)
            ->count();

        $offers = $student->activities()
            ->where('activity_type', ActivityType::Offer)
            ->count();

        return view('welcome', compact(
            'latestOpportunities',
            'recentApplications',
            'applications',
            'interviews',
            'assessments',
            'offers',
        ));
    }
}
