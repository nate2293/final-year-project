<x-layouts.app>

    <x-ui::breadcrumb :crumbs="[
        'Opportunities' => route('opportunities.index'),
        $opportunity->job_title => route('opportunities.show', $opportunity),
    ]" class="mb-4" />

    @php
        $deadline = \Carbon\Carbon::parse($opportunity->application_deadline);
        $daysLeft = now()->startOfDay()->diffInDays($deadline->startOfDay(), false);

        if ($daysLeft < 0) {
            $deadlineColour = 'text-red-600';
            $deadlineText = 'Closed';
        } elseif ($daysLeft <= 14) {
            $deadlineColour = 'text-amber-600';
            $deadlineText = $daysLeft . ' days remaining';
        } else {
            $deadlineColour = 'text-green-600';
            $deadlineText = $daysLeft . ' days remaining';
        }

        $status = $opportunity->activities->first()?->activity_type;
        $latestActivity = $opportunity->activities->sortByDesc('activity_date')->first();
    @endphp

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

        {{-- Overview --}}
        <x-application.description-list>

            <x-application.description-row>

                <x-application.description-item title="Current Status">
                    <x-ui::badge variant="light">
                        Not Applied
                    </x-ui::badge>
                </x-application.description-item>

                <x-application.description-item title="Application Deadline">
                    {{ $deadline->format('d M Y') }}
                </x-application.description-item>

            </x-application.description-row>

            <x-application.description-row>

                <x-application.description-item title="Time Remaining">
                    <span class="{{ $deadlineColour }}">
                        {{ $deadlineText }}
                    </span>
                </x-application.description-item>

                <x-application.description-item title="Category">
                    {{ $opportunity->job_category }}
                </x-application.description-item>

            </x-application.description-row>

            <x-application.description-row>

                <x-application.description-item title="Location">
                    {{ $opportunity->company->company_address }}
                </x-application.description-item>

                <x-application.description-item title="Company">
                    {{ $opportunity->company->company_name }}
                </x-application.description-item>

            </x-application.description-row>

        </x-application.description-list>

        {{-- About --}}
        <x-application.section title="About">

            <p class="leading-8 text-gray-700 dark:text-gray-300">
                {{ $opportunity->job_description }}
            </p>

        </x-application.section>

        {{-- Requirements --}}
        <x-application.section title="Requirements">

            <p class="leading-8 text-gray-700 dark:text-gray-300">
                {{ $opportunity->requirements }}
            </p>

        </x-application.section>

        {{-- Next Step --}}
        <x-application.section title="Next Step">

            @if ($latestActivity)

                <div class="flex justify-end gap-3">

                    <x-ui::link
                        href="{{ route('activities.create', ['opportunity' => $opportunity->id]) }}"
                        variant="blue">

                        Log Activity

                    </x-ui::link>

                    <x-ui::link
                        href="{{ route('opportunities.index') }}"
                        variant="light">

                        Back to Opportunities

                    </x-ui::link>

                </div>

            @else

                <p class="text-gray-600 dark:text-gray-300">
                    You haven't logged any activity for this opportunity yet.
                    Start tracking your application journey by logging your activity.
                </p>

                <div class="mt-6 flex justify-end gap-3">

                    <x-ui::link
                        href="{{ route('activities.create', ['opportunity' => $opportunity->id]) }}"
                        variant="blue">

                        Log Activity

                    </x-ui::link>

                    <x-ui::link
                        href="{{ route('opportunities.index') }}"
                        variant="light">

                        Back to Opportunities

                    </x-ui::link>

                </div>

            @endif

        </x-application.section>

    </x-ui::card>

</x-layouts.app>