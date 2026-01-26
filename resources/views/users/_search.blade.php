<form method="GET" :action="route('users.index')" class="form flex gap-2 items-center my-4">
    <x-ui.form.input placeholder="search..." name="search" value="{{ $search }}" class="text-xs" />
    
    <x-ui.button variant="dark" type="submit" class="text-xs">        
        Search
    </x-ui.button>
    <x-ui.link variant="light" class="text-xs" href="{{ route('users.index') }}">Clear</x-ui.link>
</form>
