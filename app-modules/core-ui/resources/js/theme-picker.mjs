import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

Alpine.directive("core-ui-theme-picker", function (el, _, { cleanup }) {
    const theme = localStorage.getItem("theme") ?? "system";
    const active = el.querySelector(`[value='${theme}']`);
    if (active) active.checked = true;
    const handler = (event) => {
        const theme = event.target.value;
        if (theme === "system") localStorage.removeItem("theme");
        else localStorage.setItem("theme", theme);
        if (
            theme === "dark" ||
            (theme === "system" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    };
    el.addEventListener("change", handler);
    cleanup(() => el.removeEventListener("change", handler));
});
