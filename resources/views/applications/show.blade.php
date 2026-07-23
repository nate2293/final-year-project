<x-layouts.app>

    <x-slot name="title">
        Application Details
    </x-slot>

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Software Developer Placement
                </h1>

                <p class="mt-2 text-gray-600">
                    Turner, Hackett and Bartell
                </p>
            </div>

            <span class="inline-flex items-center rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700">
                Application
            </span>

        </div>

        {{-- Application Details --}}
        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    Application Details
                </h2>
            </div>

            <div class="grid gap-6 p-6 md:grid-cols-2">

                <div>
                    <p class="text-sm font-medium text-gray-500">Company</p>
                    <p class="mt-1 text-gray-900">
                        Turner, Hackett and Bartell
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Opportunity</p>
                    <p class="mt-1 text-gray-900">
                        Software Developer Placement
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Location</p>
                    <p class="mt-1 text-gray-900">
                        Belfast
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Applied Date</p>
                    <p class="mt-1 text-gray-900">
                        22 July 2026
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Closing Date</p>
                    <p class="mt-1 text-gray-900">
                        15 August 2026
                    </p>
                </div>

            </div>

        </div>

        {{-- Notes --}}
        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    Notes
                </h2>
            </div>

            <div class="p-6">

                <p class="text-gray-600">
                    No notes have been added for this application.
                </p>

            </div>

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between">

            <a href="{{ route('applications.index') }}"
                class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">

                Back to Applications

            </a>

            <button class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700">

                Update Status

            </button>

        </div>

    </div>

</x-layouts.app>
