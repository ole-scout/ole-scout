<x-slot:title>{{ __('Login mit Scout-Konto') }}</x-slot:title>
<x-slot:size>sm</x-slot:size>
<div>
    <form wire:submit="login" class="flex flex-col gap-4">
        <x-ui::field
            :id="$this->id() . '-email'"
            type="text"
            name="loginForm.email"
            wire:model.live.debounce.200ms="loginForm.email">
            <x-slot:label>{{ __('Benutzername oder E-Mail-Adresse') }}</x-slot:label>
            <x-slot:hint>{{ __('*Pflichtfeld') }}</x-slot:hint>
        </x-ui::field>
        <x-ui::field 
            :id="$this->id() . '-password'"
            type="password"
            name="loginForm.password"
            wire:model="loginForm.password">
            <x-slot:label>{{ __('Passwort') }}</x-slot:label>
            <x-slot:hint
                component="ui::button"
                variant="link">{{ __('Passwort vergessen?') }}</x-slot:hint>
            <x-slot:actionTrailing
                component="ui::toggle-button"
                variant="alt"
                onIcon="eye-off"
                offIcon="eye"
                alpineState="$checked"
                x-on:ui-toggle="
                    $el.closest('.field').querySelector('input').type = (
                        $event.detail ? 'text' : 'password'
                    )"
                :onIconTitle="__('Passwort verbergen')"
                :offIconTitle="__('Passwort anzeigen')"
                hiddenLabel>
                <span data-when-checked="show" hidden="hidden">{{ __('Passwort verbergen') }}</span>
                <span data-when-checked="hide">{{ __('Passwort anzeigen') }}</span>
            </x-slot:actionTrailing>
        </x-ui::field>
        <x-ui::label class="place-self-start" trailing>
            {{ __('Auf diesem Gerät merken') }}
            <x-slot:wrap
                component="ui::checkbox"
                wire:model="loginForm.remember"></x-slot:wrap>
        </x-ui::label>
        <x-ui::button
            size="lg"
            type="submit"
            class="place-self-end">Einloggen</x-ui::button>
    </form>
</div>
