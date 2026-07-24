<x-layouts.app>

    <x-ui::breadcrumb :crumbs="[
        'Home' => route('home'),
        'Contact' => '',
    ]" />
  
    <x-divider>
        <x-ui::heading level="3">Contact</x-ui::heading>
    </x-divider>

</x-layouts.app>
