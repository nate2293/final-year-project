<x-layouts.app>
    <x-ui.breadcrumb :crumbs="[
        'Home' => route('home'),
        'Settings' => route('settings.profile.edit'),
        'Profile' => '#',
    ]" />

    <x-ui.divider>
        <x-ui.heading level="3">Profile</x-ui.heading>       
        <p class="text-gray-600 dark:text-gray-400 mt-1">Update your name and email address</p>
    </x-ui.divider>

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar Navigation -->
            @include('settings._navigation')

            <!-- Profile Content -->
            <div class="flex-1">
                <x-ui.card class="mb-6">
                    <!-- Profile Form -->
                    <form class="max-w-md mb-10" action="{{ route('settings.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-ui.form.input label="Name" name="name" type="text"
                                value="{{ old('name', $user->name) }}" />
                        </div>

                        <div class="mb-6">
                            <x-ui.form.input label="Email" name="email" type="email"
                                value="{{ old('email', $user->email) }}" />
                        </div>

                        <div>
                            <x-ui.button variant="dark" type="submit">Save</x-ui.button>
                        </div>
                    </form>

                    <!-- Delete Account Section -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                        <x-ui.heading level="3" class="mb-1">
                            Delete account
                        </x-ui.heading>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Delete your account and all of its resources
                        </p>
                        <form action="{{ route('settings.profile.destroy') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete your account?')">
                            @csrf
                            @method('DELETE')
                            <x-ui.button variant="red" type="submit">Delete account</x-ui.button>
                        </form>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layouts.app>
