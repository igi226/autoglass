<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404 Page Not Found</title>
    <link href="{{ asset('vendors') }}/assets/css/style.css" rel="stylesheet">
</head>

<body class="main-body">

    <div class="main-error-wrapper">
        <h1>404</h1>
        <h2>Sorry, an error has occured, Requested Page not found!</h2>
        <h6>You may have mistyped the address or the page may have moved.</h6> <a class="btn btn-outline-indigo"
            href="{{ route('vendor.index') }}">Back to Home</a>
    </div>
</body>

</html>
