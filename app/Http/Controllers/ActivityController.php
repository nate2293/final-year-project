<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Activity;
use App\Enums\ActivityType;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;


use function Symfony\Component\Clock\now;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve pagination and sort query parameters
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $size = $request->get('size', 10);

        // 
        $student = Student::where('user_id', auth()->user()->id)->first();
        // dd(auth()->id(), $student);



        // Load activities, applying sort and pagination 
        $activities = Activity::where('student_id', $student->id)
            ->sortable($sort, $direction)
            ->paginate($size)
            ->withQueryString();


        return view('activities.index', compact('activities'));
    }

    // Download pdf function
    // Auth -> gets user 
    // user id finds row with that student and pulls activities for that related student
    // .company loads related data to a company
    // activities.pdf loads view and turns into a pdf 
    public function downloadPdf()
    {
        $user = Auth::user();

        $student = Student::where('user_id', $user->id)->first();

        // Safety check could be taken out. 
        if (!$student) {
            return redirect()->route('activities.index');
        }

        $activities = Activity::with(['opportunity.company'])
            ->where('student_id', $student->id)
            ->orderByDesc('activity_date')
            ->get();

        $disk = Storage::disk('public');
        $tempDirectory = storage_path('framework/cache');
        $tocPath = tempnam($tempDirectory, 'activities_toc_');

        if ($tocPath === false) {
            abort(500, 'Unable to create a temporary PDF file.');
        }

        Pdf::loadView('activities.pdf', ['activities' => $activities, 'user' => $user, 'student' => $student])
            ->setPaper('A4')
            ->save($tocPath);

        $merger = PDFMerger::init();

        try {
            // Add the generated table of contents first, then the uploaded activity PDFs.
            $merger->addPDF($tocPath, 'all');

            foreach ($activities as $activity) {
                // if ($activity->evidence_link == null || (! $disk->exists($activity->evidence_link))) {
                //     abort(404, "Missing activity PDF: {$activity->evidence_link}");
                // }
                if ($activity->evidence_link != null && $disk->exists($activity->evidence_link)) {
                    $merger->addPDF($disk->path($activity->evidence_link), 'all');
                }
            }

            $merger->setFileName('evidence.pdf');
            $merger->merge();

            return $merger->download();
        } finally {
            if (is_file($tocPath)) {
                unlink($tocPath);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedOpportunity = $request->query('opportunity');

        if ($selectedOpportunity) {

            $opportunity = Opportunity::with('company')->findOrFail($selectedOpportunity);

            $opportunityOptions = [
                $opportunity->id => "{$opportunity->job_title} — {$opportunity->company->company_name}",
            ];
        } else {

            $opportunityOptions = Opportunity::with('company')
                ->orderBy('job_title')
                ->get()
                ->mapWithKeys(fn($o) => [
                    $o->id => "{$o->job_title} — {$o->company->company_name}"
                ])
                ->toArray();
        }

        $activityOptions = ActivityType::options();

        $activity = new Activity;
        $activity->activity_date = now();

        return view('activities.create', compact(
            'activity',
            'opportunityOptions',
            'activityOptions',
            'selectedOpportunity'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1) Validate: ensures the form submitted is what your DB expects
        $data = $request->validate([
            'opportunity_id' => ['required', 'integer', 'exists:opportunities,id'],
            'activity_type' => ['required', new Enum(ActivityType::class)],
            'activity_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'evidence_link' => ['required', File::types(['pdf'])->max(5000)],
        ]);

        $user = Auth::user();

        $student = $user->student;


        if (!$student) {
            $student = Student::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'university' => 'Unknown',
                'phone_number' => null,
                'address' => null,
                'linkedin_profile' => null,
            ]);
        }

        $data['student_id'] = $student->id;

        Activity::create($data);

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activity logged successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {

        $opportunityOptions = Opportunity::with('company')->orderBy('company_id')->get()->mapWithKeys(fn($o) => [$o->id => "{$o->company->company_name} - {$o->job_title}"]);

        $activityOptions = ActivityType::options();
        return view('activities.edit', compact('activity', 'opportunityOptions', 'activityOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'opportunity_id' => ['required', 'integer', 'exists:opportunities,id'],
            'activity_type' => ['required', new Enum(ActivityType::class)],
            'activity_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'evidence_link' => ['required', File::types(['pdf'])->max(5000)],
        ]);

        $activity->update($data);

        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity deleted successfully.');
    }
}
