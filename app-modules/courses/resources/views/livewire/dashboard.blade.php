<x-slot:title>{{ __('Dashboard') }}</x-slot:title>
<ul>
    <li><x-ui::button :href="route('courses.root')">{{ __('Course overview') }}</x-ui::button></li>
    <li><x-ui::button href="/admin">{{ __('Admin panel') }}</x-ui::button></li>
</ul>
