@props(['title'])

<div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4">

    <dt>
        <x-ui::heading level="5">
            {{ $title }}
        </x-ui::heading>
    </dt>

    <dd class="mt-2 text-sm font-semibold text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
        {{ $slot }}
    </dd>

</div>
