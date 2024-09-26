<x-authentication::layout.app {{ $attributes->merge(['title' => $title ?? null]) }}>
    <style>
        .login-background {
            background-image: url("{{ asset('assets/images/auth-bg.jpg') }}");
            background-color: #cccccc;
            height: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>
    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <x-authentication::layout.header />

            <div
                class="d-flex col-12 col-lg-5 col-xl-5 align-items-center authentication-bg"
            >
                <div class="w-px-400 mx-auto">
                    <x-authentication::layout.brand-logo />
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-authentication::layout.app>
