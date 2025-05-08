<!-- Global stylesheets -->
<link href="{{ asset('assets/admin/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/noty/noty.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
{{--@vite(['resources/css/app.scss'])--}}
<!-- /global stylesheets -->


{{--<!-- Css custom -->--}}
@yield('style_custom')
{{--<!-- /Css custom  -->--}}

<style>
    .swal2-icon-content {
        font-size: 1.2em !important;
    }

    .swal2-success-line-tip {
        height: 0 !important;
    }

    figure.image {
        margin: 0 !important;
        display: block !important;
        width: 100% !important;
    }

    figure.image img {
        max-width: 100% !important;
        height: auto !important;
        display: block !important;
    }

    .image {
        margin: 0 !important;
        display: block !important;
        width: 100% !important;
    }

    .image img {
        max-width: 100% !important;
        height: auto !important;
        display: block !important;
    }

    .icon-2x {
        font-size: 2em;
    }

</style>


@livewireStyles
