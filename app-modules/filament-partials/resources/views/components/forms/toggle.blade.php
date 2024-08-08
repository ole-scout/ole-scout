@props([
    'alpineActive' => null,
    'initialChecked' => null,
    'disabled' => false,
])
<button
    x-bind:aria-checked="{{ $alpineActive }}"
    x-bind:style="
        {{ $alpineActive }}
            ? '{{
                \Filament\Support\get_color_css_variables(
                    'primary',
                    shades: [600],
                    alias: 'forms::components.toggle.on',
                )
            }}'
            : '{{
                \Filament\Support\get_color_css_variables(
                    'gray',
                    shades: [600],
                    alias: 'forms::components.toggle.off',
                )
            }}'
    "
    {{ $disabled ? 'disabled' : '' }}
    aria-checked="{{ $initialChecked ? 'true' : 'false' }}"
    role="switch"
    type="button"
    {{ $attributes->class([
        'relative inline-flex h-6 transition-colors duration-200 ease-in-out border-2 border-transparent rounded-full outline-none cursor-pointer fi-fo-toggle w-11 shrink-0 disabled:pointer-events-none disabled:opacity-70 fi-color-custom bg-custom-600 disabled:grayscale',
    ]) }}
>
    <span
        class="relative inline-block w-5 h-5 transition duration-200 ease-in-out transform bg-white rounded-full shadow pointer-events-none ring-0"
        x-bind:class="{
            'translate-x-5 rtl:-translate-x-5': {{ $alpineActive }},
            'translate-x-0': ! {{ $alpineActive }},
        }"
    >
        <span
            class="absolute inset-0 flex items-center justify-center w-full h-full transition-opacity"
            aria-hidden="true"
            x-bind:class="{
                'opacity-0 ease-out duration-100': {{ $alpineActive }},
                'opacity-100 ease-in duration-200': ! {{ $alpineActive }},
            }"
        >
        </span>

        <span
            class="absolute inset-0 flex items-center justify-center w-full h-full transition-opacity"
            aria-hidden="true"
            x-bind:class="{
                'opacity-100 ease-in duration-200': {{ $alpineActive }},
                'opacity-0 ease-out duration-100': ! {{ $alpineActive }},
            }"
        >
        </span>
    </span>
</button>