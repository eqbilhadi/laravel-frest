<x-layouts.app.app {{ $attributes }}>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- Aside --}}
            <x-layouts.app.aside />

            <div class="layout-page">
                {{-- Navbar --}}
                <x-layouts.app.navbar />

                <div class="content-wrapper">
                    {{ $slot }}

                    <x-layouts.app.footer />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.app>