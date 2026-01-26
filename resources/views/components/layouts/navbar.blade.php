<x-ui.navbar class="text-sm">
    {{-- Brand Icon --}}
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

    {{-- Brand Title --}}
    <x-slot:brand-title>
        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            {{ config('app.name') }}
        </span>
    </x-slot:brand-title>

    <x-slot:navigation>
        <x-ui.navbar.link href="/" icon="home" label="Home" />

         <x-ui.navbar.dropdown label="Company" icon="folder">
            <x-ui.navbar.link href="/about" icon="info" label="About Us" />
             <x-ui.navbar.link href="/contact" icon="info" label="Contact Us" />
        </x-ui.navbar.dropdown>

    </x-slot:navigation>

    <x-slot:user>
        @guest
            <x-ui.navbar.link icon="user" href="{{ route('login') }}" label="Login" />
        @endguest
        @auth
            <x-ui.navbar.dropdown label="{{ auth()->user()->name }}" icon="user">
                <x-ui.navbar.link label="Help" :href="route('help')" icon="info" />
                {{-- <x-ui.navbar.link @click="dark = !dark" icon="moon" label="Toggle" /> --}}
                <x-ui.navbar.link icon="cog" label="Profile" href="/settings/profile" />       
                <x-ui.navbar.form-link action="/logout" icon="arrow-left-end-on-rectangle" method="post" label="Logout" />
            </x-ui.navbar.dropdown>
        @endauth
    </x-slot:user>

    <x-ui.flash position="bottom-right" />

    {{-- content slot --}}
    {{ $slot }}

    <x-slot:toolbar>
        <x-ui.navbar.link href="/settings/profile" icon="user" />
        <x-ui.navbar.link @click="dark = !dark" icon="moon" />
        <x-ui.navbar.link :href="route('help')" icon="info" />
    </x-slot:toolbar>
</x-ui.navbar>
