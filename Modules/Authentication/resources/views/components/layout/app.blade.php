<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-semi-dark"
    data-assets-path="{{ asset('assets') . '/' }}"
    data-template="vertical-menu-template"
>
    <head>
        <meta charset="utf-8" />
        <title>
            {{ config("app.name") }} {{ isset($title) ? " - ".$title : "" }}
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="laravel frest template" name="description" />
        <meta content="EqtadaBilhadi" name="author" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @include('components.layouts.auth.includes.styles')
    </head>

    <body>
        {{ $slot }}
        @include('components.layouts.auth.includes.scripts')
    </body>
</html>
