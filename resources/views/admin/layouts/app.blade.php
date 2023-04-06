
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
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/summernote/summernote-bs4.css">
 
  @yield('style')
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('admins') }}/assets/css/components.css">
<!-- Start GA -->

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      
      @include('components.admin.topbar')
      @include('components.admin.sidebar')

      @yield('content')
      <!-- Main Content -->
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 
          <script>
            document.write((new Date()).getFullYear())
          </script>
          <div class="bullet"></div>Made By GOGI
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
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
  <script src="{{ asset('admins') }}/assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/chart.min.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="{{ asset('admins') }}/assets/modules/izitoast/js/iziToast.min.js"></script>
  <!-- Page Specific JS File -->
  
  @yield('script')
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