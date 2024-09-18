import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

const inputSelector =
    ":is(input, select, textarea, button):not([x-ui-busy\\:ignore],[x-ui-busy\\:ignore] *)";

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 */
const disableInputs = (el) => {
    const rollbacks = [];
    const inputs = el.querySelectorAll(
        `${inputSelector}:not([x-bind:disabled])`
    );
    for (const input of inputs) {
        if (input.hasAttribute("disabled")) continue;
        input.setAttribute("disabled", "disabled");
        rollbacks.push(() => input.removeAttribute("disabled"));
    }
    return () => {
        while (rollbacks.length) {
            const rollback = rollbacks.pop();
            rollback();
        }
    };
};

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const BusyForm = (el, { expression }, { effect, evaluateLater }) => {
    if (expression === "x-ui-busy" || !expression) expression = "isSubmitting";
    const isBusy = evaluateLater(expression);
    const rollbacks = {};
    const inputs = el.querySelectorAll(inputSelector);
    for (const input of inputs) {
        if (input.hasAttribute("x-bind:disabled")) {
            const condition = input.getAttribute("x-bind:disabled");
            input.setAttribute(
                "x-bind:disabled",
                `(${condition}) || (${expression})`
            );
        } else {
            input.setAttribute("x-bind:disabled", expression);
        }
    }
    effect(() => {
        isBusy((busy) => {
            if (busy) {
                if (!rollbacks[expression]) rollbacks[expression] = [];
                rollbacks[expression].push(disableInputs(el));
            } else {
                if (!rollbacks[expression]) return;
                const rollback = rollbacks[expression].pop();
                if (rollback) rollback();
            }
        });
    });
};

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const BusyButton = (
    el,
    { expression },
    { effect, evaluate, evaluateLater }
) => {
    if (expression === "x-ui-busy" || !expression) expression = "isSubmitting";
    const isBusy = evaluateLater(expression);
    let previous = false;
    effect(() => {
        isBusy((busy) => {
            if (!previous) {
                if (busy === (el.name || true)) {
                    el.classList.add("busy");
                    previous = true;
                }
            } else {
                el.classList.remove("busy");
                previous = false;
            }
        });
    });
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
