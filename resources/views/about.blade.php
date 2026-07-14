<x-layouts.app>

    <x-ui::breadcrumb :crumbs="[
        'Home' => '/',
        'About' => '#',
    ]" />

    <x-ui::divider>
        <x-ui::heading level="3">About</x-ui::heading>
    </x-ui::divider>


    <x-ui::modal.open target="demo" class="btn btn-primary">
        Demo Modal
    </x-ui::modal.open>

    <x-ui::modal name="demo" class="bg-scroll">

        <x-slot:title>
            <x-ui::heading level="3">Demo</x-ui::heading>
        </x-slot:title>

        <form method="POST" action="{{ route('users.update', auth()->user()->id) }}">
            @csrf

            <x-ui::form.select class="mb-2" label="Role" name="user_role" :options="\App\Enums\Role::options()"
                value="{{ auth()->user()->role }}" />

            <div class="flex gap-2">
                <x-ui::form.range class="mb-2" label="Reputation" name="reputation" :min="0" :max="10"
                    :value="2" class="w-3/4" />
                <x-ui::form.toggle class="mb-2" label="Active" name="active" label="Active" :value="true"
                    class="w-1/4" />
            </div>

            <x-ui::form.datetime-picker class="mb-2" label="Subscription Ends At" name="subscription_ends_at"
                :value="now()->addMonth()" />

            <x-ui::form.otp label="Two Factor Authentication Code" name="otp_code" length="6" class="my-2" />

            <x-ui::divider type="bottom">
                <div>
                    <x-ui::button type="submit">Save</x-ui::button>
                    <x-ui::modal.close target="demo" variant="link">Cancel</x-ui::modal.close>
                </div>
            </x-ui::divider>

        </form>

    </x-ui::modal>


</x-layouts.app>
