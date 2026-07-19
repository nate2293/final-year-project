@auth

    <x-layouts.app>

        <x-ui::breadcrumb :crumbs="[
            'Opportunities' => route('opportunities.index'),
        ]" />

        <x-ui::card>

            <x-ui::heading level="3" class="mb-2">
                Opportunities
            </x-ui::heading>

            <form method="GET" action="{{ route('opportunities.index') }}" class="mb-6">

                <div class="flex items-end gap-4">

                    {{-- Search --}}
                    <div class="flex flex-col justify-end flex-1">
                        <x-ui::form.input-group name="search" :value="request('search')"
                            placeholder="Search by job title or company..." />
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col justify-end">
                        <x-ui::form.select-group label="Status" name="status" :options="$statusOptions" :value="request('status')"
                            onchange="this.form.submit()" />
                    </div>

                    <div class="flex flex-col justify-end"> <x-ui::link href="{{ route('opportunities.index') }}"
                            variant="oblue">
                            Clear Filters
                        </x-ui::link>
                    </div>

                </div>

            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach ($opportunities as $opportunity)
                    <x-opportunity-card :id="$opportunity->id" :title="$opportunity->job_title" :company="$opportunity->company->company_name" :category="$opportunity->job_category"
                        :location="$opportunity->company->company_address" :deadline="$opportunity->application_deadline" :description="$opportunity->job_description" :requirements="$opportunity->requirements" :status="null"
                        :activities="$opportunity->activities" />
                @endforeach
            </div>

            <div class="mt-4 px-4 pb-4">
                <x-ui::paginator :items="$opportunities" size="4" />
            </div>

        </x-ui::card>


    </x-layouts.app>

@endauth
