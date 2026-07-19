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

        <p class="font-semibold text-gray-900 dark:text-white">
            {{ $company }}
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $category }}
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $location }}
        </p>

        <div class="flex items-center justify-between">

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Applications close:
                <span class="font-semibold text-gray-900 dark:text-white">
                    {{ $deadlineDate->format('d M Y') }} at 23:59
                </span>
            </p>

            <span class="text-sm font-semibold {{ $deadlineColour }}">
                {{ $deadlineLabel }}
            </span>

        </div>

    </div>

    <x-slot:footer>

        <div class="flex justify-end">

            <x-ui::link href="{{ route('opportunities.show', $id) }}" variant="light" icon="information">

            </x-ui::link>

        </div>

    </x-slot:footer>

</x-ui::card>
