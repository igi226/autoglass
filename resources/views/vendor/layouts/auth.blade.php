<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} - @yield('title')</title> <!-- Font Awesome -->
    <link href="{{ asset('vendors') }}/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet"> <!-- Bootstrap -->
    <link href="{{ asset('vendors') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Ionicons -->
    <link href="{{ asset('vendors') }}/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet"> <!-- Typicons -->
    <link href="{{ asset('vendors') }}/assets/plugins/typicons.font/typicons.css" rel="stylesheet"> <!-- Sidebar css -->
    <link href="{{ asset('vendors') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet"> <!-- Switcher css -->
    <link href="{{ asset('vendors') }}/assets/switcher/css/switcher.css" rel="stylesheet"> <!-- Switcher Demo css -->
    <link rel="stylesheet" href="{{ asset('vendors') }}/assets/switcher/demo.css"> <!-- Style Css -->
    <link href="{{ asset('vendors') }}/assets/css/style.css" rel="stylesheet"> <!-- Skins Css -->
    <link href="{{ asset('vendors') }}/assets/css/skins.css" rel="stylesheet"> <!-- Icon Style -->
    <link href="{{ asset('vendors') }}/assets/css/icons.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body class="main-body sidebar-gone">
    @yield('content')
    <script src="{{ asset('vendors') }}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/ionicons/ionicons.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/moment/moment.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/sticky.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/custom.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/form-validation.js"></script>
</body>

</html>