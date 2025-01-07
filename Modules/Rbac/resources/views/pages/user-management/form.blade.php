<x-layouts.app.base title="Create User">
    <div class="container-xxl flex-grow-1 container-p-y">
        @isset($user)
            <livewire:rbac::user-management.form :com-user="$user" /> 
        @else
            <livewire:rbac::user-management.form />
        @endisset
    </div>
</x-layouts.app.base>