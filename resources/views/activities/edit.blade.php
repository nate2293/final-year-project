<x-layouts.app>
    <x-ui::breadcrumb :crumbs="[
        'Activities' => route('activities.index'),
        'Edit' => route('activities.edit', $activity),
    ]" class="mb-4" />

    <x-ui::card class="mb-6">
        <x-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-slate-100">Edit Activity</h1>

                <x-ui::link href="{{ route('activities.index') }}">
                    Back
                </x-ui::link>
            </div>
        </x-slot:header>

        <form method="POST" enctype="multipart/form-data" action="{{ route('activities.update', $activity) }}"
            class="space-y-5">
            @csrf
            @method('PUT')

            <x-ui::form.select-group label="Opportunity" name="opportunity_id" :options="$opportunityOptions"
                value="{{ old('opportunity_id', $activity->opportunity_id) }}" />

            <x-ui::form.select-group label="Activity Type" name="activity_type" :options="$activityOptions"
                value="{{ old('activity_type', $activity->activity_type) }}" />

            <x-ui::form.date-group label="Date" name="activity_date"
                value="{{ old('activity_date', $activity->activity_date) }}" />

            <x-ui::form.textarea-group name="Notes"
                label="Notes (optional)">{{ old('notes', $activity->notes) }}</x-ui::form.textarea-group>

            <x-ui::form.input-group type="File" name="evidence_link" label="Evidence Link"
                value="{{ old('evidence_link', $activity->evidence_link) }}" />

            <div class="mt-2 text-slate-200">
                    @if ($activity->evidence_link_exists)
                        <x-ui::link href="{{ $activity->evidence_link_url }}" target="_blank" >
                            Download
                        </x-ui::link>
                    @endif
                </div>

            <div class="flex gap-2 pt-2">
                <x-ui::button type="submit">Save</x-ui::button>
                <x-ui::link variant="light" href="{{ route('activities.index') }}">Cancel</x-ui::link>
            </div>
        </form>
    </x-ui::card>
</x-layouts.app>
