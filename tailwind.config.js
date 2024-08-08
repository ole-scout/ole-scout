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
};
