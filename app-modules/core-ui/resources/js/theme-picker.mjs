import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

Alpine.data("core_ui_theme_picker", () => {
    const initial = localStorage.getItem("theme") ?? "system";
    return {
        init() {
            for (const toggle of this.$el.querySelectorAll("[value]")) {
                toggle.setAttribute("x-bind", "toggle");
                if (toggle.value === initial) {
                    toggle.setAttribute("checked", "checked");
                }
            }
        },
        toggle: {
            "@change"() {
                const theme = this.$el.value;
                if (theme === "system") localStorage.removeItem("theme");
                else localStorage.setItem("theme", theme);
                if (
                    theme === "dark" ||
                    (theme === "system" &&
                        window.matchMedia("(prefers-color-scheme: dark)")
                            .matches)
                ) {
                    document.documentElement.classList.add("dark");
                } else {
                    document.documentElement.classList.remove("dark");
                }
            },
        },
    };
});
