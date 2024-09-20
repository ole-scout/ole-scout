<div
    x-ui-tab-pane
    class="[&>*+*]:hidden"
    x-init="$el.classList.remove('[&>*+*]:hidden')"
>{{ $slot }}</div>