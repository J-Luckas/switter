<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Font-Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased  bg-yellow-100">
        <div class="container mx-auto h-200">
            @livewire('navigation-menu')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            window.addEventListener('swal:confirm', event => {
                const modal = event.detail;
                Swal.fire({
                    title: modal.title,
                    html: modal.text,
                    icon: modal.type,
                    showConfirmButton:true,
                    showCancelButton: true,
                    confirmButtonText: 'Sim!',
                    cancelButtonText: 'Cancelar',
                    focusConfirm:true}
                )
                .then(result => {
                    if (result.value) {
                        window.livewire.emit('delete', modal.id);
                    }
                });
            })

            window.addEventListener('swal:actionDid', event => {
                const notification = event.detail;
                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                }).fire({
                    title: notification.title,
                    html: notification.text,
                    icon: notification.type
                });
            });
        </script>
    </body>
</html>
