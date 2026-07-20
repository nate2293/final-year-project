<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Opportunity;

class CalendarController extends Controller
{
    public function events()
    {
        $activities = Activity::with('opportunity.company')
            ->get()
            ->map(function ($activity) {

                $colour = match ($activity->activity_type->value) {
                    'application' => '#16a34a',   // Green
                    'interview'   => '#2563eb',   // Blue
                    'assessment'  => '#f59e0b',   // Orange
                    'offer'       => '#9333ea',   // Purple
                    'rejection'   => '#dc2626',   // Red
                    'follow_up'   => '#0891b2',   // Cyan
                    'networking'  => '#6b7280',   // Grey
                    default       => '#3b82f6',
                };

                $icon = match ($activity->activity_type->value) {
                    'application' => '📝',
                    'interview'   => '🎤',
                    'assessment'  => '📋',
                    'offer'       => '🎉',
                    'rejection'   => '❌',
                    'follow_up'   => '📞',
                    'networking'  => '🤝',
                    default       => '📌',
                };

                return [
                    'title' => $icon . ' ' . ucfirst(str_replace('_', ' ', $activity->activity_type->value)),
                    'start' => $activity->activity_date->format('Y-m-d'),
                    'url' => route('activities.show', $activity),


                    'backgroundColor' => $colour,
                    'borderColor' => $colour,
                    'textColor' => '#ffffff',

                    'extendedProps' => [
                        'category' => $activity->activity_type->value,
                        'type' => ucfirst(str_replace('_', ' ', $activity->activity_type->value)),
                        'company' => $activity->opportunity->company->company_name,
                        'job' => $activity->opportunity->job_title,
                        'notes' => $activity->notes,
                        'date' => $activity->activity_date->format('d M Y'),
                    ],
                ];
            });

        $deadlines = Opportunity::with('company')
            ->get()
            ->map(function ($opportunity) {

                return [
                    'title' => '⏰ Deadline',

                    'start' => \Carbon\Carbon::parse($opportunity->application_deadline)->format('Y-m-d'),

                    'backgroundColor' => '#f59e0b', // Amber
                    'borderColor' => '#f59e0b',
                    'textColor' => '#ffffff',

                    'extendedProps' => [
                        'category' => 'deadline',
                        'type' => 'Application Deadline',
                        'company' => $opportunity->company->company_name,
                        'job' => $opportunity->job_title,
                        'notes' => 'Application closes on this date.',
                        'date' => \Carbon\Carbon::parse($opportunity->application_deadline)->format('d M Y'),
                    ],
                ];
            });

        return $activities
            ->concat($deadlines)
            ->values();
    }
}
