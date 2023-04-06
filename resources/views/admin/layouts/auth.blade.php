<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/css/components.css">
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                @yield('content')
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admins') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/popper.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/tooltip.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/moment.min.js"></script>
    <script src="{{ asset('admins') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admins') }}/assets/modules/izitoast/js/iziToast.min.js"></script>
    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('admins') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('admins') }}/assets/js/custom.js"></script>

    <script>
        @if (Session::has('error'))
            iziToast.error({
                title: 'Error',
                message: "{{ Session::get('error') }}",
                position: 'topRight'
            });
        @endif
        @if (Session::has('success'))
            iziToast.success({
                title: 'Success',
                message: "{{ Session::get('success') }}",
                position: 'topRight'
            });
        @endif
    </script>
</body>

</html>
