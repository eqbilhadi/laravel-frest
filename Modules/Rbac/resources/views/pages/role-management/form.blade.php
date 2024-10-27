<x-layouts.app.base title="Create Role">
    <div class="container-xxl flex-grow-1 container-p-y">
        @isset($role)
            <livewire:rbac::role-management.form :com-role="$role" />
        @else
            <livewire:rbac::role-management.form />
        @endisset
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/libs/bs-stepper.css') }}">
    @endpush
    @push('scripts')
        <link rel="stylesheet" href="{{ asset('assets/js/libs/bs-stepper.js') }}">
    @endpush
</x-layouts.app.base>