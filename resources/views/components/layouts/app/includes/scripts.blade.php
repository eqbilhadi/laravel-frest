<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/js/libs/jquery.js') }}" data-navigate-once></script>
<script src="{{ asset('assets/js/libs/popper.js') }}" data-navigate-once></script>
<script src="{{ asset('assets/js/libs/bootstrap.js') }}" data-navigate-once></script>
<script src="{{ asset('assets/js/libs/perfect-scrollbar.js') }}" data-navigate-once></script>

<script src="{{ asset('assets/js/libs/hammer.js') }}"></script>

<script src="{{ asset('assets/js/libs/i18n.js') }}"></script>

<script src="{{ asset('assets/js/libs/menu.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
@stack('scripts')
