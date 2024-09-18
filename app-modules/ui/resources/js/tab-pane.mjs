import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

/**
 * @param {import("alpinejs").DirectiveUtilities['evaluate']} evaluate
 * @param {MouseEvent} event
 * @returns {void}
 */
const handleTablistClick = (evaluate, event) => {
    const $focus = evaluate("$focus");
    /** @type {Element} */
    const tablist = event.currentTarget;
    /** @type {Element} */
    const nextTab = event.target;
    if (!tablist || nextTab?.parentElement !== tablist) return;
    const panels = [...tablist.parentElement.children].slice(1);
    const tabs = [...tablist.children];
    const nextIndex = tabs.indexOf(nextTab);
    const nextPanel = panels[nextIndex];
    if (!nextPanel) return;
    const currentTab = tabs.find(
        (tab) => tab.getAttribute("aria-selected") === "true"
    );
    if (currentTab) {
        currentTab.setAttribute("aria-selected", "false");
        currentTab.setAttribute("tabindex", "-1");
        const currentIndex = tabs.indexOf(currentTab);
        const currentPanel = panels[currentIndex];
        if (currentPanel) {
            currentPanel.setAttribute("hidden", "hidden");
        }
    }
    nextTab.setAttribute("aria-selected", "true");
    nextTab.setAttribute("tabindex", "0");
    nextPanel.removeAttribute("hidden");
    $focus.focus(nextTab);
};

/**
 * @param {import("alpinejs").DirectiveUtilities['evaluate']} evaluate
 * @param {MouseEvent} event
 * @returns {void}
 */
const handleTablistKeyup = (evaluate, event) => {
    const $focus = evaluate("$focus");
    /** @type {Element} */
    const tablist = event.currentTarget;
    /** @type {Element} */
    const currentTab = event.target;
    if (!tablist || currentTab?.parentElement !== tablist) return;
    const panels = [...tablist.parentElement.children].slice(1);
    const tabs = [...tablist.children];
    const currentIndex = tabs.indexOf(currentTab);
    const currentPanel = panels[currentIndex];
    if (
        !currentPanel ||
        event.isComposing ||
        event.altKey ||
        event.ctrlKey ||
        event.metaKey ||
        event.shiftKey
    ) {
        return;
    }
    let nextIndex = currentIndex;
    switch (event.key) {
        default:
            return;
        case "ArrowRight":
            nextIndex = currentIndex + 1;
            if (nextIndex < tabs.length) break;
        case "Home":
            nextIndex = 0;
            break;
        case "ArrowLeft":
            nextIndex = currentIndex - 1;
            if (nextIndex >= 0) break;
        case "End":
            nextIndex = tabs.length - 1;
            break;
    }
    const nextTab = tabs[nextIndex];
    const nextPanel = panels[nextIndex];
    currentTab.setAttribute("aria-selected", "false");
    currentTab.setAttribute("tabindex", "-1");
    currentPanel.setAttribute("hidden", "hidden");
    nextTab.setAttribute("aria-selected", "true");
    nextTab.setAttribute("tabindex", "0");
    nextPanel.removeAttribute("hidden");
    $focus.focus(nextTab);
};

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const TabPane = (el, {}, { cleanup, evaluate }) => {
    if (!el.getAttribute("id")) {
        el.setAttribute("id", evaluate("$id('tab-pane')"));
    }
    const tablist = document.createElement("div");
    tablist.setAttribute("role", "tablist");
    el.classList.add("tab-pane");
    el.prepend(tablist);

    const onTablistClick = handleTablistClick.bind(
        handleTablistClick,
        evaluate
    );
    tablist.addEventListener("click", onTablistClick);
    cleanup(() => tablist.removeEventListener("click", onTablistClick));

    const onTablistKeyup = handleTablistKeyup.bind(
        handleTablistKeyup,
        evaluate
    );
    tablist.addEventListener("keyup", onTablistKeyup);
    cleanup(() => tablist.removeEventListener("keyup", onTablistKeyup));
};

/**
 * @param {import("alpinejs").ElementWithXAttributes} el
 * @param {import("alpinejs").DirectiveData} data
 * @param {import("alpinejs").DirectiveUtilities} utilities
 * @returns {void}
 */
const Tab = (el, { expression, value }, { evaluate, effect }) => {
    const { label, badge: badgeExpression } = evaluate(expression);
    const parent = el.parentElement;
    const tablist = parent.querySelector('[role="tablist"]');
    if (!tablist) {
        console.error("Misplaced ui-tab-pane tab without parent!", el);
    }
    const index = tablist.children.length;
    const tabId = `${tablist.id}_tab_${value}`;
    const panelId = `${tablist.id}_panel_${value}`;

    const tab = document.createElement("button");
    tab.innerText = label;
    const badge = document.createElement("span");
    badge.setAttribute("aria-hidden", "true");
    badge.setAttribute("class", "badge");
    tab.appendChild(badge);
    if (badgeExpression) {
        effect(() => {
            badge.innerText = evaluate(badgeExpression);
        });
    }

    tab.setAttribute("type", "button");
    tab.setAttribute("role", "tab");
    tab.setAttribute("id", tabId);
    tab.setAttribute("aria-controls", panelId);
    tab.setAttribute("x-ui-busy:ignore", "true");
    el.setAttribute("role", "tabpanel");
    el.setAttribute("id", panelId);
    el.setAttribute("aria-labelledby", tabId);
    el.setAttribute("tabindex", "0");
    if (index === 0) {
        tab.setAttribute("aria-selected", "true");
        tab.setAttribute("tabindex", "0");
        el.removeAttribute("hidden");
    } else {
        tab.setAttribute("aria-selected", "false");
        tab.setAttribute("tabindex", "-1");
        el.setAttribute("hidden", "hidden");
    }
    tablist.appendChild(tab);
};

Alpine.directive("ui-tab-pane", (el, data, utilities) => {
    if (data.value) Tab(el, data, utilities);
    else TabPane(el, data, utilities);
});
