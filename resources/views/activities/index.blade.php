<x-layouts.app>
    <x-ui::breadcrumb :crumbs="[
        'Activities' => route('activities.index'),
    ]" class="mb-4" />

    <x-ui::card class="mb-6">
        <x-slot:header>
            <div class="flex items-center justify-between">
                <x-ui::heading level="3" class="mb-2">
                    Activities
                </x-ui::heading>

                <div class="flex items-center gap-2">

                    <x-ui::link href="{{ route('activities.create') }}" variant="blue">
                        Log an Activity
                    </x-ui::link>

                    <x-ui::link variant="light" href="{{ route('activities.pdf') }}">
                        Download PDF
                    </x-ui::link>



                </div>
        </x-slot:header>

        <div class="w-full overflow-x-auto">
            <x-ui::table>
                <x-slot:thead>
                    <x-ui::table.tr>
                        <x-ui::table.th>
                            <x-ui::link-sort name="opportunity_id"> Opportunity </x-ui::link-sort>
                        </x-ui::table.th>
                        <x-ui::table.th>
                            <x-ui::link-sort name="activity_type">Activity</x-ui::link-sort>
                        </x-ui::table.th>
                        <x-ui::table.th>
                            <x-ui::link-sort name="activity_date">Date</x-ui::link-sort>
                        </x-ui::table.th>
                        <x-ui::table.th>
                            Actions
                        </x-ui::table.th>
                    </x-ui::table.tr>
                </x-slot:thead>

                <x-slot:tbody>
                    @forelse ($activities as $activity)
                        <x-ui::table.tr>
                            <x-ui::table.td>
                                {{ $activity->opportunity?->company?->company_name ?? '—' }}
                            </x-ui::table.td>
                            <x-ui::table.td>
                                {{ $activity->activity_type?->name ?? (string) $activity->activity_type }}
                            </x-ui::table.td>
                            <x-ui::table.td>
                                {{ $activity->activity_date?->format('F j, Y') ?? '—' }}
                            </x-ui::table.td>
                            <x-ui::table.td class="flex gap-1">
                                <x-ui::link href="{{ route('activities.edit', $activity) }}">
                                    Edit
                                </x-ui::link>
                                <x-ui::modal.trigger variant="link" for="{{ 'activity-' . $activity->id }}">
                                    Delete
                                </x-ui::modal.trigger>
                                @include('activities._delete')
                                <x-ui::link href="{{ route('activities.show', $activity) }}">
                                    More
                                </x-ui::link>
                            </x-ui::table.td>
                        </x-ui::table.tr>
                    @empty
                        <x-ui::table.tr>
                            <x-ui::table.td colspan="5">
                                No activities found.
                            </x-ui::table.td>
                        </x-ui::table.tr>
                    @endforelse
                </x-slot:tbody>
            </x-ui::table>



        </div>


        <div class="mt-4 px-4 pb-4">
            <x-ui::paginator :items="$activities" size="10" />
        </div>

    </x-ui::card>
</x-layouts.app>
