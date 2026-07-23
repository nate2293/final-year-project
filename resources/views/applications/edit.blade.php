<x-layouts.app>

    <x-slot name="title">
        Update Status
    </x-slot>

    <div class="max-w-2xl">

        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold">
                    Update Application Status
                </h2>
            </div>

            <div class="p-6 space-y-6">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <select
                        class="w-full rounded-lg border-gray-300">

                        <option>Application</option>
                        <option>Interview</option>
                        <option>Assessment</option>
                        <option>Offer</option>
                        <option>Rejection</option>
                        <option>Follow-up</option>

                    </select>

                </div>

                <div class="flex justify-end">

                    <button
                        class="rounded-lg bg-indigo-600 px-5 py-2.5 text-white hover:bg-indigo-700">

                        Save Status

                    </button>

                </div>

            </div>

        </div>

    </div>

</x-layouts.app>