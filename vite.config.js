import laravel, { refreshPaths } from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                ...refreshPaths,
                "app/Filament/**",
                "app/Forms/Components/**",
                "app/Livewire/**",
                "app/Infolists/Components/**",
                "app/Providers/Filament/**",
                "app/Tables/Columns/**",
                "app-modules/*/src/Filament/**",
                "app-modules/*/src/Forms/Components/**",
                "app-modules/*/src/Livewire/**",
                "app-modules/*/src/Infolists/Components/**",
                "app-modules/*/src/Providers/Filament/**",
                "app-modules/*/src/Tables/Columns/**",
                "app-modules/*/resources/**",
                "app-modules/ui/src/helpers.php",
                "resources/css/**",
                "resources/js/**",
            ],
        }),
    ],
});
