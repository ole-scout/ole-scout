import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const Indeterminate = (el, { expression }, { effect, evaluateLater }) => {
    const isIndeterminate = evaluateLater(expression);
    effect(() => {
        isIndeterminate((indeterminate) => {
            el.indeterminate = Boolean(indeterminate);
        });
    });
};

Alpine.directive("ui-indeterminate", Indeterminate);
