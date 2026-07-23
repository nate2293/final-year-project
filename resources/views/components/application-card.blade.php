@props(['application'])


<div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">

    <div class="p-6">

        <div class="flex items-start justify-between">

            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ $application->opportunity->job_title }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $application->opportunity->company->company_name }}
                </p>
            </div>

            <x-ui::badge :variant="$application->activity_type->badgeColor()">
                {{ $application->activity_type->value }}
            </x-ui::badge>

        </div>

        <div class="mt-6 grid grid-cols-2 gap-4">

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Applied
                </p>

                <p class="mt-1 text-sm font-medium text-gray-900">
                    {{ $application->activity_date->format('d F Y') ?? 'Not Recorded' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Closing Date
                </p>

                <p class="mt-1 text-sm font-medium text-gray-900">
                    {{ $application->opportunity->application_deadline?->format('d F Y') ?? 'Not Specified' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Location
                </p>

                <p class="mt-1 text-sm font-medium text-gray-900">
                    {{ $application->opportunity->company->company_location }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Last Updated
                </p>

                <p class="mt-1 text-sm font-medium text-gray-900">
                    Today
                </p>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-between">

            <span class="text-sm text-gray-500">
                Tracking Application
            </span>

            <a href="{{ route('applications.show', $application) }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">

                View Application

            </a>

        </div>

    </div>

</div>
