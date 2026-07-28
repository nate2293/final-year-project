@props([
    'id',
    'title',
    'company',
    'category',
    'location',
    'deadline',
    'description',
    'requirements',
    'status',
    'activities',
])

@php
    use Carbon\Carbon;

    $modal = 'opportunity-' . $id;

    $deadlineDate = Carbon::parse($deadline);
    $daysRemaining = now()->startOfDay()->diffInDays($deadlineDate->startOfDay(), false);

    if ($daysRemaining < 0) {
        $deadlineColour = 'text-red-600';
        $deadlineLabel = 'Deadline Passed';
    } elseif ($daysRemaining === 0) {
        $deadlineColour = 'text-red-600';
        $deadlineLabel = 'Closes Today';
    } elseif ($daysRemaining === 1) {
        $deadlineColour = 'text-red-600';
        $deadlineLabel = '1 day left';
    } elseif ($daysRemaining <= 7) {
        $deadlineColour = 'text-red-600';
        $deadlineLabel = "{$daysRemaining} days left";
    } elseif ($daysRemaining <= 14) {
        $deadlineColour = 'text-yellow-600';
        $deadlineLabel = "{$daysRemaining} days left";
    } else {
        $deadlineColour = 'text-green-600';
        $deadlineLabel = "{$daysRemaining} days left";
    }

@endphp

<x-ui::card>

    <x-slot:header>

        <div class="flex items-center justify-between gap-3">

            <x-ui::heading level="5">
                {{ $title }}
            </x-ui::heading>

            @if ($status)
                <x-ui::badge :variant="$status->badgeColor()">
                    {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                </x-ui::badge>
            @else
                <x-ui::badge variant="light">
                    Not Applied
                </x-ui::badge>
            @endif

        </div>

    </x-slot:header>

    <div class="space-y-5">

    <div>

        <p class="font-semibold text-gray-900 dark:text-white">
            {{ $company }}
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $location }}
        </p>

    </div>

    <div class="grid grid-cols-2 gap-5">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Category
            </p>

            <p class="font-semibold text-gray-900 dark:text-white">
                {{ $category }}
            </p>

        </div>

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Closing Date
            </p>

            <p class="font-semibold text-gray-900 dark:text-white">
                {{ $deadlineDate->format('d F Y') }}
            </p>

        </div>

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Location
            </p>

            <p class="font-semibold text-gray-900 dark:text-white">
                {{ $location }}
            </p>

        </div>

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Time Remaining
            </p>

            <p class="font-semibold {{ $deadlineColour }}">
                {{ $deadlineLabel }}
            </p>

        </div>

    </div>

</div>

    <x-slot:footer>

        <div class="flex justify-end">

            <x-ui::link href="{{ route('opportunities.show', $id) }}" variant="light" icon="eye">

            </x-ui::link>

        </div>

    </x-slot:footer>

</x-ui::card>
