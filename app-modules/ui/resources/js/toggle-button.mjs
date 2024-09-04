document.addEventListener("alpine:init", () => {
    Alpine.directive(
        "ui-toggle-button",
        function (el, _, { cleanup, evaluate }) {
            const handler = (event) => {
                const $el = event.currentTarget;
                const checked = $el.ariaChecked !== "true";
                $el.ariaChecked = checked;
                let hidden = $el.querySelectorAll('[data-when-checked="show"]');
                let shown = $el.querySelectorAll('[data-when-checked="hide"]');
                if (!checked) [hidden, shown] = [shown, hidden];
                for (const toShow of hidden) toShow.removeAttribute("hidden");
                for (const toHide of shown)
                    toHide.setAttribute("hidden", "hidden");
                evaluate(`$dispatch('ui-toggle', ${checked});`);
            };
            el.addEventListener("click", handler);
            cleanup(() => el.removeEventListener("click", handler));
        }
    );
});
