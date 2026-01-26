<x-layouts.app>
    <x-ui.breadcrumb :crumbs="[
        'Activities' => route('activities.index'),
        'Create' => route('activities.create'),
    ]" class="mb-4" />

    <x-ui.card class="mb-6">
        <x-slot:header>
            <h1 class="text-2xl font-semibold text-slate-100">Log an Application</h1>
            <p class="mt-2 text-slate-300">Fill in the details below and submit.</p>
        </x-slot:header>

        <form method="POST" action="{{ route('activities.store') }}" class="space-y-5" enctype="multipart/form-data">
            @csrf

            <x-ui.form.input name="employer_name" label="Company Name" :value="old('employer_name')" />

            <x-ui.form.input name="title" label="Job Title" :value="old('title')" />

            <x-ui.form.textarea name="description" label="Job Description">{{ old('description') }}</x-ui.form.textarea>

            <x-ui.form.textarea name="main_duties" label="Main Duties">{{ old('main_duties') }}</x-ui.form.textarea>

            <x-ui.form.input type="file" name="file" label="Evidence PDF" />

            <div class="flex gap-2 pt-2">
                <x-ui.button type="submit">Save</x-ui.button>
                <x-ui.link variant="light" href="{{ route('activities.index') }}">Cancel</x-ui.link>
            </div>
        </form>
    </x-ui.card>
</x-layouts.app>
