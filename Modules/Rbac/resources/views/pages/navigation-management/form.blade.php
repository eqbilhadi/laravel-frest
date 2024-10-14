<x-layouts.app.base title="Create Navigation">
    <div class="container-xxl flex-grow-1 container-p-y">
        @isset($menu)
            <livewire:rbac::navigation-management.form :com-menu="$menu" />
        @else
            <livewire:rbac::navigation-management.form />
        @endisset
    </div>
</x-layouts.app.base>
