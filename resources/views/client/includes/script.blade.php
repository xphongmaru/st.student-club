<!-- JS
============================================ -->
<script src="{{asset('assets/client/js/vendor/modernizr.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/jquery.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/waypoint.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/wow.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/counterup.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/feather.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/sal.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/masonry.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/imageloaded.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/magnify.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/lightbox.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/easypie.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/text-type.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/jquery.style.swicher.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/js.cookie.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/jquery-one-page-nav.js')}}"></script>
<script src="{{asset('assets/client/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/client/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/bootstrap.min.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/client/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    feather.replace();
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@livewireScripts

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('flashMessage', ({ type, message }) => {

        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
        };

        switch (type) {
            case 'success':
                toastr.success(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'info':
                toastr.info(message);
                break;
            default:
                toastr.info(message);
                break;
        }
    });
    });

    document.addEventListener('livewire:init', () => {
        Livewire.on('openModel', ({type,title,text,confirmEvent}) => {
            console.log(type)
            Swal.fire({
                title: title,
                icon: type,
                text: text,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Có!",
                cancelButtonText: "Không!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(confirmEvent);
                }
            });
        });
    });

</script>

{{--<!-- JS custom -->--}}
@yield('script_custom')
{{--<!-- /JS custom  -->--}}

