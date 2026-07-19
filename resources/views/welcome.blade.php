@auth

    <x-layouts.app>

        <x-ui::breadcrumb :crumbs="[
            'Dashboard' => '/',
        ]" />

        <x-ui::card>

            <x-slot:header>

                <x-ui::heading level="3">
                    Dashboard
                </x-ui::heading>

            </x-slot:header>

            {{-- Statistics & Calendar --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

                {{-- Statistics --}}
                <div class="xl:col-span-1 space-y-4">

                    <x-ui::statistic title="Applications" :value="$applications" variant="blue" description="Applications Submitted" />

                    <x-ui::statistic title="Interviews" :value="$interviews" variant="blue" description="Interviews Received" />

                    <x-ui::statistic title="Assessments" :value="$assessments" variant="blue" description="Pending Assessments" />

                    <x-ui::statistic title="Offers" :value="$offers" variant="blue" description="Offers Received" />

                </div>

                {{-- Calendar --}}
                <div class="xl:col-span-2">

                    <x-ui::card>

                        <x-slot:header>

                            <x-ui::heading level="5">
                                Activity Calendar
                            </x-ui::heading>

                        </x-slot:header>

                        <div id="calendar"></div>

                    </x-ui::card>

                </div>

            </div>

            {{-- Dashboard Cards --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                {{-- Recent Activity --}}
                <x-ui::card>

                    <x-slot:header>

                        <x-ui::heading level="5">
                            Recent Activity
                        </x-ui::heading>

                    </x-slot:header>

                    <div class="divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse ($recentApplications as $activity)
                            <div class="flex items-center justify-between py-4">

                                <div>

                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $activity->opportunity->company->company_name }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $activity->opportunity->job_title }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $activity->created_at->diffForHumans() }}
                                        •
                                        {{ $activity->activity_date->format('d M Y') }}
                                    </p>

                                </div>

                                <x-ui::badge :variant="$activity->activity_type->badgeColor()">
                                    {{ $activity->activity_type->value }}
                                </x-ui::badge>

                            </div>

                        @empty

                            <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                                No recent activity found.
                            </div>
                        @endforelse

                    </div>

                    <x-slot:footer>

                        <div class="flex justify-end">

                            <x-ui::link href="{{ route('activities.index') }}">
                                View All Activities
                            </x-ui::link>

                        </div>

                    </x-slot:footer>

                </x-ui::card>

                {{-- Latest Opportunities --}}
                <x-ui::card>

                    <x-slot:header>

                        <x-ui::heading level="5">
                            Latest Opportunities
                        </x-ui::heading>

                    </x-slot:header>

                    <div class="divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse ($latestOpportunities as $opportunity)
                            <div class="flex items-center justify-between py-4">

                                <div>

                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $opportunity->company->company_name }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $opportunity->job_title }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Apply by:
                                        {{ \Carbon\Carbon::parse($opportunity->application_deadline)->format('d M Y') }}
                                    </p>

                                </div>

                                <x-ui::badge variant="light">
                                    Not Applied
                                </x-ui::badge>

                            </div>

                        @empty

                            <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                                No opportunities found.
                            </div>
                        @endforelse

                    </div>

                    <x-slot:footer>

                        <div class="flex justify-end">

                            <x-ui::link href="{{ route('opportunities.index') }}">
                                View All Opportunities
                            </x-ui::link>

                        </div>

                    </x-slot:footer>

                </x-ui::card>

            </div>

        </x-ui::card>

    </x-layouts.app>

@endauth
