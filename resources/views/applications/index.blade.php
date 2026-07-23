@props(['application'])

<x-layouts.app>

    <x-ui::card class="mb-6">

        <x-slot name="title">
            Applications
        </x-slot>

        <div class="space-y-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-900 mt-5">
                    My Applications
                </h1>

                <p class="mt-2 text-gray-600 mt-5">
                    Track the progress of your placement applications and manage their current status.
                </p>

            </div>

            {{-- <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @forelse($applications as $application)
                    <x-application-card :application="$application" />

                @empty

                    <div class="col-span-full">

                        <div class="rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center">

                            <h2 class="text-xl font-semibold text-gray-900">

                                No Applications Yet

                            </h2>

                            <p class="mt-3 text-gray-600">

                                Browse opportunities and apply to begin tracking your placement journey.

                            </p>

                            <a href="{{ route('opportunities.index') }}"
                                class="mt-6 inline-flex rounded-lg bg-indigo-600 px-5 py-2.5 text-white">

                                Browse Opportunities

                            </a>

                        </div>

                    </div>
                @endforelse

            </div> --}}

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($applications as $application)
                    <x-application-card :application="$application" />

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

        </div>

    </x-ui::card>

</x-layouts.app>
