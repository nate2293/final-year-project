<x-layouts.app>
    <x-ui.breadcrumb
        :crumbs="[
            'Activities' => route('activities.index'),
        ]"
        class="mb-4"
    />

    <x-ui.card class="mb-6">
        <x-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-slate-100">Activities</h1>

                <x-ui.link href="{{ route('activities.create') }}">
                    Log an Activitie
                </x-ui.link>
            </div>
        </x-slot:header>

        <p class="text-slate-300">Activities list page.</p>

        <x-slot:footer>
            <span class="text-sm text-slate-400">Footer</span>
        </x-slot:footer>
    </x-ui.card>
</x-layouts.app>
