import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const ToggleButton = (el, { value: toggleAttr }, { cleanup, evaluate }) => {
    if (!toggleAttr) toggleAttr = "data-when-checked";
    const handler = (event) => {
        const $el = event.currentTarget;
        const checked = $el.ariaChecked !== "true";
        $el.ariaChecked = checked;
        let hidden = $el.querySelectorAll(`[${toggleAttr}="show"]`);
        let shown = $el.querySelectorAll(`[${toggleAttr}="hide"]`);
        if (!checked) [hidden, shown] = [shown, hidden];
        for (const toShow of hidden) toShow.removeAttribute("hidden");
        for (const toHide of shown) toHide.setAttribute("hidden", "hidden");
        evaluate(`$dispatch('ui-toggle', ${checked});`);
    };
    el.addEventListener("click", handler);
    cleanup(() => el.removeEventListener("click", handler));
};

Alpine.directive("ui-toggle-button", ToggleButton);
