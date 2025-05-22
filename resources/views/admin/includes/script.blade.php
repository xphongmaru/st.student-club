{{--<!-- Core JS files -->--}}
<script src="{{ asset('assets/admin/demo/demo_configurator.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
{{--<!-- /core JS files -->--}}

{{--<!-- Theme JS files -->--}}
<script src="{{ asset('assets/admin/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/noty/noty.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('assets/admin/js/money/simple.money.format.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/init.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/forms/selects/select2.min.js') }}"></script>
{{--<!-- /theme JS files -->--}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>--}}

<script src="{{ asset('assets/admin/js/vendor/editors/ckeditor/ckeditor_document.js') }}"></script>
{{--<script src="{{ asset('assets/admin/js/editor_ckeditor_classic.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/editor_ckeditor_document.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/ckeditor5.umd.js') }}"></script>--}}

@yield('script')
{{--<!-- JS custom -->--}}
@yield('script_custom')
{{--<!-- /JS custom  -->--}}

@livewireScripts

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Session Flash Messages
        @if (session('success'))
        showNoty('success', "{{ session('success') }}");
        @endif

        @if (session('error'))
        showNoty('error', "{{ session('error') }}");
        @endif

        @if (session('warning'))
        showNoty('warning', "{{ session('warning') }}");
        @endif

        @if (session('info'))
        showNoty('info', "{{ session('info') }}");
        @endif

        // Realtime Livewire Flash Messages
        if (typeof Livewire !== 'undefined') {
            Livewire.on('flashMessage', ({ type, message }) => {
                showNoty(type, message);
            });
        }
    });

    function showNoty(type, message) {
        new Noty({
            type: type,
            layout: 'topRight',
            text: message,
            timeout: 3000,
            progressBar: true,
            closeWith: ['button'],
            callbacks: {
                onTemplate: function() {
                    let color = '#188251'; // Default: success green
                    if (type === 'error') color = '#D9534F'; // Red
                    if (type === 'warning') color = '#FFC107'; // Yellow
                    if (type === 'info') color = '#17A2B8'; // Blue
                    this.barDom.innerHTML = '<div class="noty_body" style="background: ' + color + '; color: #ffffff;">' + this.options.text + '</div>';
                    this.barDom.style.backgroundColor = 'transparent';
                }
            }
        }).show();
    }

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
