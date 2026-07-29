<x-layouts.app>

    <x-ui::breadcrumb :crumbs="[
        'Applications' => route('applications.index'),
    ]" />

    <x-ui::card class="mb-6">



        <x-slot name="title">
            Applications
        </x-slot>


        <div class="space-y-8">

            <div>

                <x-ui::heading level="3" class="mt-5">
                    My Applications
                </x-ui::heading>

                <form method="GET" action="{{ route('applications.index') }}" class="mb-6">

                    <div class="flex items-end gap-4">

                        {{-- Search --}}
                        <div class="flex flex-col justify-end flex-1">
                            <x-ui::form.input-group name="search" :value="request('search')"
                                placeholder="Search by job title or company..." />
                        </div>

                        {{-- Status --}}
                        <div class="flex flex-col justify-end">
                            <x-ui::form.select-group label="Status" name="status" :options="$activityOptions" :value="request('status')"
                                onchange="this.form.submit()" />
                        </div>

                        {{-- Clear --}}
                        <div class="flex flex-col justify-end">
                            <x-ui::link href="{{ route('applications.index') }}" variant="light">
                                Clear Filters
                            </x-ui::link>
                        </div>

                    </div>

                </form>


            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($applications as $application)
                    <x-application-card :application="$application" :activityOptions="$activityOptions" />

                @empty



                    <div class="col-span-full">

                        <div class="rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center">

                            <h2 class="text-xl font-semibold text-gray-900">
                                No Applications Yet
                            </h2>

                            <p class="mt-2 text-gray-600">
                                Browse opportunities and apply for one to start tracking your applications.
                            </p>

                            <a href="{{ route('opportunities.index') }}"
                                class="mt-6 inline-flex rounded-lg bg-indigo-600 px-5 py-2.5 text-white hover:bg-indigo-700">

                                Browse Opportunities

                            </a>

                        </div>

                    </div>
                @endforelse

            </div>

            <div class="mt-4 px-4 pb-4">
                <x-ui::paginator :items="$applications" size="4" />
            </div>

        </div>

    </x-ui::card>

</x-layouts.app>
