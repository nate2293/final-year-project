<x-ui::modal name="{{ 'activity-' . $activity->id }}" focusable>
    <x-slot:title>
        Delete Activity
    </x-slot:title>

    <p>
        Are you sure you want to delete {{ $activity->id }}
    </p>

    <x-slot:footer>
        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-ui::button type="submit" variant="red">Delete</x-ui::button>
        </form>
    </x-slot:footer>
</x-ui::modal>
