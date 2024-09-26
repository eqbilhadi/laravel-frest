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
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="laravel frest template" name="description" />
        <meta content="EqtadaBilhadi" name="author" />
        <meta charset="utf-8" />
        <title>
            {{ config("app.name") }} {{ isset($title) ? " - ".$title : "" }}
        </title>
        @include('components.layouts.app.includes.styles')
    </head>
    <body>
        {{ $slot }}
        @include('components.layouts.app.includes.scripts')
    </body>
</html>
