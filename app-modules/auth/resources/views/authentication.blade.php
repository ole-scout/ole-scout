<div>
    <form wire:submit="login" class="flex flex-col max-w-xl gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow mt-80 dark:bg-gray-900">
        <x-ui::field :id="$this->id() . '-email'" type="text" name="loginForm.email" wire:model.live.debounce.200ms="loginForm.email">
            <x-slot:label>{{ __('E-Mail') }}</x-slot:label>
            <x-slot:hint>{{ __('*Pflichtfeld') }}</x-slot:hint>
        </x-ui::field>
        <x-ui::field :id="$this->id() . '-password'" type="password" name="loginForm.password" wire:model="loginForm.password">
            <x-slot:label>{{ __('Passwort') }}</x-slot:label>
            <x-slot:hint component="ui::button" variant="link">{{ __('Passwort vergessen?') }}</x-slot:hint>
            <x-slot:actionTrailing component="ui::toggle-button" variant="alt" onIcon="eye-off" offIcon="eye" alpineState="$checked" x-on:ui-toggle="$el.closest('.field').querySelector('input').type = $event.detail ? 'text' : 'password'" hiddenLabel>{{ __('Passwort anzeigen') }}</x-slot:actionTrailing>
        </x-ui::field>
        <x-ui::button type="submit" class="place-self-end">Submit</x-ui::button>
    </form>
</div>
