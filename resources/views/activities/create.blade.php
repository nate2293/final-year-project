<x-layouts.app>
    <x-ui::breadcrumb :crumbs="[
        'Activities' => route('activities.index'),
        'Create' => route('activities.create'),
    ]" class="mb-4" />

    <x-ui::card class="mb-6">
        <x-slot:header>
            <h1 class="text-2xl font-semibold text-gray-900">Log an Activity</h1>
            <p class="mt-2 text-gray-600">Fill in the details below and submit.</p>
        </x-slot:header>

        <form method="POST" action="{{ route('activities.store') }}" class="space-y-5" enctype="multipart/form-data">
            @csrf

            <x-ui::form.select-group label="Opportunity" name="opportunity_id" :options="$opportunityOptions" :value="old('opportunity_id', $selectedOpportunity ?? $activity->opportunity_id)" />

            <x-ui::form.select-group label="Activity Type" name="activity_type" :options="$activityOptions"
                value="{{ old('activity_type', $activity->activity_type) }}" />

            <x-ui::form.date-group label="Date" name="activity_date"
                value="{{ old('activity_date', $activity->activity_date) }}" />

            <x-ui::form.textarea-group name="Notes"
                label="Notes (optional)">{{ old('notes', $activity->notes) }}</x-ui::form.textarea>

                <x-ui::form.input-group type="File" name="evidence_link" label="Evidence Link"
                    value="{{ old('evidence_link', $activity->evidence_link) }}" />

                <div class="flex gap-2 pt-2">
                    <x-ui::button type="submit">Save</x-ui::button>
                    <x-ui::link variant="light" href="{{ route('activities.index') }}">Cancel</x-ui::link>
                </div>
        </form>
    </x-ui::card>
</x-layouts.app>
