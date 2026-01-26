<?php

use Livewire\Component;

new class extends Component
{
    public string $name;

    public function mount(string $name)
    {
        $this->name = $name;

    }

   public function render()
    {
        return function (array $data) {
            /** @var ComponentSlot $slot */
            $slot = $data['slot'];

            // Inject 'name' into slot children so they receive it automatically
            $slot->with(['name' => $this->name]);
            return view('ui.form.group', [
                'slot' => $slot,
                'name' => $this->name,
                'for' => $this->name,
                'attributes' => $data['attributes'],
            ])->render();
        };
    }

};
?>

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    {{ $slot }}
</div>