import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./app/Livewire/**/*.php",
        "./app-modules/*/src/Filament/**/*.php",
        "./app-modules/*/src/Livewire/**/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
};
