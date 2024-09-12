<!doctype html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} {{ isset($title) ? ' - ' . $title : '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="laravel frest template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('components.layouts.auth.includes.styles')
</head>

<body>
    
    {{ $slot }}
    @include('components.layouts.auth.includes.scripts')
</body>

</html>
