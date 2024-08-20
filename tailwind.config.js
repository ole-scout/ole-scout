import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./app/Livewire/**/*.php",
        "./resources/views/**/*.blade.php",
        "./app-modules/*/src/Filament/**/*.php",
        "./app-modules/*/src/Livewire/**/*.php",
        "./app-modules/*/resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50: "rgba(var(--brand-50), <alpha-value>)",
                    100: "rgba(var(--brand-100), <alpha-value>)",
                    200: "rgba(var(--brand-200), <alpha-value>)",
                    300: "rgba(var(--brand-300), <alpha-value>)",
                    400: "rgba(var(--brand-400), <alpha-value>)",
                    500: "rgba(var(--brand-500), <alpha-value>)",
                    600: "rgba(var(--brand-600), <alpha-value>)",
                    700: "rgba(var(--brand-700), <alpha-value>)",
                    800: "rgba(var(--brand-800), <alpha-value>)",
                    900: "rgba(var(--brand-900), <alpha-value>)",
                    950: "rgba(var(--brand-950), <alpha-value>)",
                },
            },
        },
    },
};
