<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        $query = Opportunity::with(['company', 'activities'])
            ->whereDate('application_deadline', '>=', now());

        $search = request('search');
        $status = request('status');


        if (! empty($search)) {


            $query->where(function ($query) use ($search) {

                $query->where('job_title', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($query) use ($search) {
                        $query->where('company_name', 'like', "%{$search}%");
                    });
            });
        }

        if (! empty($status)) {

            $query->whereHas('activities', function ($query) use ($status) {

                $query->where('activity_type', $status);
            });
        }

        $opportunities = $query->paginate(6)->withQueryString();

        $statusOptions = [
            '' => 'All',
        ] + ActivityType::options();

        return view('opportunities.index', compact(
            'opportunities',
            'statusOptions'
        ));
    }

    public function show(Opportunity $opportunity)
    {
        return view('opportunities.show', compact('opportunity'));
    }
}
