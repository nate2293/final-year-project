<x-ui::sidebar>

    {{-- Brand Icon always displayed --}}
    <x-slot:brand-icon>
        <svg class="w-8 h-8 dark:text-gray-100" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Icon Circle -->
            <circle cx="16" cy="16" r="14" fill="#3B82F6" />

            <!-- Generic App/Dashboard Icon -->
            <rect x="10.5" y="10.5" width="4" height="4" rx="1" fill="white" />
            <rect x="17.5" y="10.5" width="4" height="4" rx="1" fill="white" />
            <rect x="10.5" y="17.5" width="4" height="4" rx="1" fill="white" />
            <rect x="17.5" y="17.5" width="4" height="4" rx="1" fill="white" />
        </svg>
    </x-slot:brand-icon>

    {{-- Brand Title  (optional and hidden when sidebar collapsed) --}}
    <x-slot:brand-title>
        <span class="mt-2 text-base font-light  text-slate-700 dark:text-slate-100">
            {{ config('app.name') }}
        </span>
    </x-slot:brand-title>

    {{-- Primary Navigation --}}
    <x-slot:navigation>
        <x-ui::sidebar.link href="/" icon="home" label="Dashboard" />

        <x-ui::sidebar.link href="{{ route('activities.index') }}" icon="list" label="Activity" />

        <x-ui::sidebar.link :href="route('opportunities.index')" icon="book-open" label="Opportunities" />

        <x-ui::sidebar.link :href="route('applications.index')" icon="document" label="Applications" />

    </x-slot:navigation>

    {{-- User Section - displays in toolbar when in mobile mode --}}
    <x-slot:user>
        @guest
            <x-ui::sidebar.link icon="user" href="{{ route('login') }}" label="Login" />
        @endguest
        @auth
            <x-ui::sidebar.dropdown label="{{ auth()->user()->name }}" icon="user">
                <x-ui::sidebar.link icon="cog" label="Profile" href="/settings/profile" />
                <x-ui::sidebar.form-link :action="route('logout')" icon="exit" method="post" label="Logout" />
            </x-ui::sidebar.dropdown>
        @endauth
    </x-slot:user>

    {{-- Toolbar --}}
    <x-slot:toolbar>

        <x-ui::sidebar.link @click="dark = !dark" icon="moon" />
        <x-ui::sidebar.link :href="route('help')" icon="info" />
        @impersonating
            <x-ui::sidebar.link class="text-red-600 font-bold" icon="exit" href="{{ route('users.mirror.stop') }}" />
        @endimpersonating
    </x-slot:toolbar>

    {{-- Main content slot --}}
    {{ $slot }}

</x-ui::sidebar>
