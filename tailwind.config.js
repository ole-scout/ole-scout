import ui from "./app-modules/ui/tailwind.config.preset";
import filament from "./vendor/filament/support/tailwind.config.preset";

/**
 * @type {import('tailwindcss').Config}
 */
export default {
    darkMode: "class",
    presets: [filament, ui],
    content: [
        "./app/Filament/**/*.php",
        "./app/Livewire/**/*.php",
        "./resources/views/**/*.blade.php",
        "./app-modules/*/src/Filament/**/*.php",
        "./app-modules/*/src/Livewire/**/*.php",
        "./app-modules/*/resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
};
