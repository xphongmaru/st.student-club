<!doctype html>
<html lang="en">
@include('client.includes.head')
<body>
<!--Main navbar-->
@include('client.includes.header')

@yield('content')

@include('client.includes.footer')
<!-- Start Top To Bottom Area  -->
<div class="rainbow-back-top">
    <i data-feather="arrow-up"></i>
</div>

@include('client.includes.loader')
<!-- End Top To Bottom Area  -->
@include('client.includes.script')


</body>
</html>
