@props(['application', 'activityOptions'])

<x-ui::card>

    <x-slot:header>

        <div class="flex items-center justify-between gap-3">

            <x-ui::heading level="5">
                {{ $application->opportunity->job_title }}
            </x-ui::heading>

            <x-ui::badge :variant="$application->activity_type->badgeColor()">
                {{ $application->activity_type->value }}
            </x-ui::badge>

        </div>

    </x-slot:header>

    <div class="space-y-5">

        <div>

            <p class="font-semibold text-gray-900 dark:text-white">
                {{ $application->opportunity->company->company_name }}
            </p>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $application->opportunity->company->company_location }}
            </p>

        </div>

        <div class="grid grid-cols-2 gap-5">

            <div>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Applied
                </p>

                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $application->activity_date?->format('d F Y') ?? 'Not Recorded' }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Closing Date
                </p>

                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $application->opportunity->application_deadline?->format('d F Y') ?? 'Not Specified' }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Location
                </p>

                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $application->opportunity->company->company_location }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Last Updated
                </p>

                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $application->updated_at->format('d F Y') }}
                </p>

            </div>

        </div>

    </div>

    <x-slot:footer>

        <div class="flex justify-end">

            <x-ui::link
                href="{{ route('activities.show', $application) }}"
                variant="light"
                icon="eye">

            </x-ui::link>

        </div>

    </x-slot:footer>

</x-ui::card>