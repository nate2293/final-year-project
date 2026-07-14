<x-layouts.app>
    <x-ui::breadcrumb :crumbs="[
        'Activities' => route('activities.index'),
        'More' => route('activities.show', $activity),
    ]" class="mb-4" />

    <x-ui::card class="mb-6">
        <x-slot:header>
            <div class="flex items-center justify-between">
                <div>
                    <x-ui::heading level="3">Activity Details</x-ui::heading>
                    <p class="mt-2 text-slate-300">
                        View the details you logged for this activity.
                    </p>
                </div>
            </div>
        </x-slot:header>

        <div class="space-y-6">
            {{-- Opportunity / Company --}}
            <div class="rounded-lg bg-slate-900/30 ring-1 ring-inset ring-slate-700 p-4">
                <div class="text-xs uppercase tracking-wide text-slate-400">Opportunity</div>
                <div class="mt-1 text-lg font-semibold text-slate-100">
                    {{ $activity->opportunity?->job_title ?? '—' }}
                </div>

                <div class="mt-2 text-sm text-slate-300">
                    <span class="text-slate-400">Company:</span>
                    {{ $activity->opportunity?->company?->company_name ?? '—' }}
                </div>
            </div>

            {{-- Status / Date --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-slate-900/30 ring-1 ring-inset ring-slate-700 p-4">
                    <div class="text-xs uppercase tracking-wide text-slate-400">Status</div>
                    <div class="mt-1 text-lg font-semibold text-slate-100">
                        {{ $activity->activity_type?->name ?? (string) $activity->activity_type }}
                    </div>
                </div>

                <div class="rounded-lg bg-slate-900/30 ring-1 ring-inset ring-slate-700 p-4">
                    <div class="text-xs uppercase tracking-wide text-slate-400">Date</div>
                    <div class="mt-1 text-lg font-semibold text-slate-100">
                        {{ $activity->activity_date?->format('F j, Y') ?? '—' }}
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="rounded-lg bg-slate-900/30 ring-1 ring-inset ring-slate-700 p-4">
                <div class="text-xs uppercase tracking-wide text-slate-400">Notes</div>
                <div class="mt-2 text-slate-200 whitespace-pre-line">
                    {{ $activity->notes ?? '—' }}
                </div>
            </div>

            {{-- Evidence link --}}
            <div class="rounded-lg bg-slate-900/30 ring-1 ring-inset ring-slate-700 p-4">
                <div class="text-xs uppercase tracking-wide text-slate-400">Evidence Link</div>
                <div class="mt-2 text-slate-200">
                    @if ($activity->evidence_link_exists)
                        <a href="{{ $activity->evidence_link_url }}" target="_blank"
                            class="underline text-indigo-300 hover:text-indigo-200">
                            Download
                        </a>
                    @else
                        —
                    @endif
                </div>
            </div>

            {{-- May take out delete not sure.. --}}
            <div class="flex justify-end items-center gap-2">

                <x-ui::link href="{{ route('activities.index') }}">
                    <x-ui::button variant="light">Back</x-ui::button>
                </x-ui::link>

                <x-ui::link variant="light" href="{{ route('activities.edit', $activity) }}">
                    Edit
                </x-ui::link>

                <form action="{{ route('activities.destroy', $activity) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-ui::button type="submit" variant="red">
                        Delete
                    </x-ui::button>
                </form>
            </div>
        </div>
    </x-ui::card>
</x-layouts.app>
