<div
    x-ui-tab-pane
    x-cloak-children
    class="[&>*+*]:hidden"
    x-init="$el.classList.remove('[&>*+*]:hidden')"
>{{ $slot }}</div>