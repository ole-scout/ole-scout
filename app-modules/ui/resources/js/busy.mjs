import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

const inputSelector =
    ":is(input, select, textarea, button):not([x-ui-busy\\:ignore],[x-ui-busy\\:ignore] *)";

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const BusyForm = (el, { expression }) => {
    if (expression === "x-ui-busy" || !expression) expression = "isSubmitting";
    const inputs = el.querySelectorAll(inputSelector);
    for (const input of inputs) {
        let condition = expression;
        if (input.hasAttribute("x-bind:disabled")) {
            condition = `(${input.getAttribute(
                "x-bind:disabled"
            )}) || (${condition})`;
        } else if (input.hasAttribute("disabled")) continue;
        input.setAttribute("x-bind:disabled", condition);
    }
};

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const BusyButton = (el, { expression }) => {
    if (expression === "x-ui-busy" || !expression) expression = "isSubmitting";
    const name = JSON.stringify(el.name || true);
    expression = `((${expression}) === ${name})`;
    let condition = `${expression} && 'busy'`;
    if (el.hasAttribute("x-bind:class")) {
        condition = el.getAttribute("x-bind:class");
        if (condition.startsWith("{")) {
            condition = `{ 'busy': ${expression}, ${condition.slice(1)}`;
        } else {
            condition = `[${expression} && 'busy', ${condition}].filter(Boolean).join(' ')`;
        }
    }
    el.setAttribute("x-bind:class", condition);
};

Alpine.directive(
    "ui-busy",
    /**
     * @param {import("alpinejs").ElementWithXAttributes} el
     * @param {import("alpinejs").DirectiveData} data
     * @param {import("alpinejs").DirectiveUtilities} utilities
     * @returns {void}
     */
    (el, data, utilities) => {
        if (data.value === "ignore") return;
        if (el.tagName === "FORM") BusyForm(el, data, utilities);
        else BusyButton(el, data, utilities);
    }
);
