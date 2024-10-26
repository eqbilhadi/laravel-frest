<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/fontawesome.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/css/theme-semi-dark.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/libs/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/libs/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/libs/select2.css') }}" />

<!-- Page CSS -->
@stack('styles')
<style>
    #nprogress {
        .bar {
            z-index: 2000 !important;
        }
    }
</style>

<!-- Helpers -->
<script src="{{ asset('assets/js/helpers.js') }}"></script>
