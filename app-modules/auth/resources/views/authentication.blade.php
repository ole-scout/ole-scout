<x-slot:title>{{ __('Log in') }}</x-slot:title>
<x-slot:crumbs :crumbs="false"></x-slot:crumbs>
<x-slot:size>sm</x-slot:size>
<x-ui::dialog>
    <x-slot:title>{{ __('Log in with Scout account') }}</x-slot:title>
    <x-slot:icon icon="icon-ole-scout"></x-slot:icon>
    <form wire:submit="login" class="flex flex-col gap-4">
        <x-ui::field name="loginForm.email">
            <x-slot:input
                type="text"
                wire:model.live.debounce.200ms="loginForm.email"
            ></x-slot:input>
            <x-slot:label>{{ __('Username or email address') }}</x-slot:label>
            <x-slot:hint>{{ __('*required') }}</x-slot:hint>
        </x-ui::field>
        <x-ui::field name="loginForm.password">
            <x-slot:actionTrailing
                component="ui::toggle-button"
                variant="alt"
                onIcon=":eye-off"
                offIcon=":eye"
                x-on:ui-toggle="$el.closest('.field').querySelector('input').type = (
                    $event.detail ? 'text' : 'password'
                )"
                :onIconTitle="__('Hide password')"
                :offIconTitle="__('Show password')"
                hiddenLabel>
                <span data-when-checked="show" hidden="hidden">{{ __('Hide password') }}</span>
                <span data-when-checked="hide">{{ __('Show password') }}</span>
            </x-slot:actionTrailing>
            <x-slot:input
                type="password"
                wire:model="loginForm.password"
            ></x-slot:input>
            <x-slot:label>{{ __('Password') }}</x-slot:label>
            <x-slot:hint
                component="ui::button"
                variant="link">{{ __('Forgot password?') }}</x-slot:hint>
        </x-ui::field>
        <x-ui::field name="loginForm.remember" class="place-self-start" inline="trailing">
            <x-slot:input
                component="ui::checkbox"
                wire:model="loginForm.remember"></x-slot:input>
            <x-slot:label>{{ __('Remember me') }}</x-slot:label>
        </x-ui::field>
        <x-ui::button
            size="lg"
            type="submit"
            class="place-self-end">{{ __('Log in') }}</x-ui::button>
    </form>
</x-ui::dialog>
