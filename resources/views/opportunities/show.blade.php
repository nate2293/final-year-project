<x-layouts.app>

    <x-ui::breadcrumb :crumbs="[
        'Opportunities' => route('opportunities.index'),
        $opportunity->job_title => route('opportunities.show', $opportunity),
    ]" class="mb-4" />


    <x-ui::card class="mt-6">

        {{-- Header --}}
        <x-ui::header>
            <x-ui::heading level="3">
                {{ $opportunity->job_title }}
            </x-ui::heading>

            <p class="mt-2 text-gray-500 dark:text-gray-400">
                {{ $opportunity->company->company_name }}
            </p>
        </x-ui::header>

        {{-- Body --}}
        <x-ui::display class="mb-1" label="Job Title" value="{{ $opportunity->job_title }}" />
        <x-ui::display class="mb-1" label="Company" value="{{ $opportunity->company->company_name }}" />
        <x-ui::display class="mb-1" label="Address" value="{{ $opportunity->company->company_address }}" />
        <x-ui::display class="mb-1" label="Industry" value="{{ $opportunity->company->industry }}" />
        <x-ui::display class="mb-1" label="Location" value="{{ $opportunity->company_location }}" />
        <x-ui::display class="mb-1" label="Job Description" value="{{ $opportunity->job_description }}" />

        {{-- Requirements Header--}}
        <x-ui::header>
            <x-ui::heading level="3" class="mb-2">
                Requirements
            </x-ui::heading>
        </x-ui::header>

        {{-- Requirements Body --}}
        <x-ui::display class="mb-1" label="Requirements" value="{{ $opportunity->requirements }}" />
        <x-ui::display class="mb-1" label="Deadline" value="{{ $opportunity->application_deadline }}" />
        
        {{-- Log Activity and Back to Opportunities --}}
        <div class="mt-6 flex justify-end gap-3">
            
            <x-ui::link href="{{ route('activities.create', ['opportunity' => $opportunity->id]) }}" variant="blue">
                Log Activity
            </x-ui::link>

            <x-ui::link href="{{ route('opportunities.index') }}" variant="light">
                Back to Opportunities
            </x-ui::link>

        </div>

        
    </x-ui::card>

</x-layouts.app>
