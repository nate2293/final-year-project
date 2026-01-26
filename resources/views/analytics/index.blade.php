<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200 dark:text-gray-100">
            Analytics & Reporting
        </h2>
    </x-slot>

    <div class="p-6 space-y-8">

        <!-- Top Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Applications Submitted -->
            <div class="bg-gray-800 shadow rounded-lg p-6 border border-gray-700">
                <h3 class="text-gray-300 text-sm font-medium">Applications Submitted</h3>
                <p class="mt-3 text-3xl font-bold text-white">0</p>
                <p class="text-xs text-gray-500 mt-2">Last updated: today</p>
            </div>

            <!-- CVs Uploaded -->
            <div class="bg-gray-800 shadow rounded-lg p-6 border border-gray-700">
                <h3 class="text-gray-300 text-sm font-medium">Resumes Uploaded</h3>
                <p class="mt-3 text-3xl font-bold text-white">0</p>
                <p class="text-xs text-gray-500 mt-2">No uploads detected</p>
            </div>

            <!-- Profile Completion -->
            <div class="bg-gray-800 shadow rounded-lg p-6 border border-gray-700">
                <h3 class="text-gray-300 text-sm font-medium">Profile Completion</h3>
                <p class="mt-3 text-3xl font-bold text-white">0%</p>
                <div class="mt-3 w-full bg-gray-700 h-2 rounded-full">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Placeholder Chart -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h3 class="text-gray-300 text-lg font-semibold mb-4">Activity Overview</h3>
            <div class="h-48 flex items-center justify-center text-gray-500">
                <p>Chart placeholder (e.g., applications over time)</p>
            </div>
        </div>

        <a href="{{ route('applications.report.download') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            Download Placement Report
        </a>


        <!-- Recent Activity Section -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h3 class="text-gray-300 text-lg font-semibold mb-4">Recent Activity</h3>

            <ul class="space-y-3">
                <li class="text-gray-500 text-sm">No recent activity to display.</li>
            </ul>
        </div>

    </div>
</x-layouts.app>
