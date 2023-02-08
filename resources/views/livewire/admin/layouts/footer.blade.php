<div>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('admin/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Perfect-scrollbar js -->
    <script src="{{asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <!-- Sidemenu js -->
    <script src="{{asset('admin/plugins/sidemenu/sidemenu.js')}}"></script>

    <!-- Sidebar js -->
    <script src="{{asset('admin/plugins/sidebar/sidebar.js')}}"></script>


    <script src="{{asset('admin/js/form-elements.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{asset('admin/js/sticky.js')}}"></script>

    @stack('jsBeforCustomJs')

<!-- Custom js -->
    <script src="{{asset('admin/js/custom.js')}}"></script>
    <script>
        $(function() {
            $("#picture").on('click', function() {
                $("#fileinput").trigger('click');
            });
        });
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('jsAfterCustomJs')
    <script>

        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        document.addEventListener('livewire:load', () => {
            Livewire.on('toast', (type, message) => {
                Toast.fire({
                    icon: type,
                    title: message
                })

            })
        })


    </script>
    @stack('modals')
    <livewire:scripts/>
    @stack('jsPanel')
</div>
