<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="socket.io" data-server="{{ env('WEBSOCKET_SERVER') }}" data-protocol-number="{{ get_user_details()->id }}" data-note-route="{{ route('vendor.notifications') }}" data-pk="{{ env('WEBSOCKET_PUBLIC_KEY') }}">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"> <!-- Title -->
    <title>{{ env('APP_NAME') }} - @yield('title')</title> <!-- Font Awesome -->
    <link href="{{ asset('vendors') }}/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('vendors') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link href="{{ asset('vendors') }}/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <!-- Typicons -->
    <link href="{{ asset('vendors') }}/assets/plugins/typicons.font/typicons.css" rel="stylesheet">
    <!-- Sidebar css -->
    <link href="{{ asset('vendors') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <!-- morris css -->
    <link rel="stylesheet" href="{{ asset('vendors') }}/assets/plugins/toast/css/toast.min.css">
    <!--Bootstrap-daterangepicker css-->
    <!-- Default Style -->
    <link href="{{ asset('vendors') }}/assets/css/style.css" rel="stylesheet"> <!-- Skins Css -->
    <link href="{{ asset('vendors') }}/assets/css/skins.css" rel="stylesheet"> <!-- Icon Style -->
    <link href="{{ asset('vendors') }}/assets/css/icons.css" rel="stylesheet">
</head>

<body class="main-body sidebar-gone">
    @include('components.vendor.header')
    @yield('content')


    @include('components.vendor.error')
    @include('components.notification')
    @include('components.vendor.report')
    <script src="{{ asset('vendors') }}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/ionicons/ionicons.js"></script>
    <script src="{{ asset('vendors') }}/assets/plugins/toast/js/jquery.toast.js"></script>
    <script src="{{ asset('common') }}/socket.io.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/sticky.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/notification.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/custom.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/html2canvas.min.js"></script>
    <script src="{{ asset('vendors') }}/assets/js/report.js"></script>
    <script>
        @if (Session::has('success'))
            $.toast({
                heading: 'Success!',
                text: '{{ Session::get('success') }}',
                icon: "success",
                hideAfter: 3000,
                allowToastClose:false
            })
        @elseif(Session::has('error'))
            $.toast({
                heading: 'Error',
                text: '{{ Session::get('error') }}',
                icon: "danger",
                hideAfter: 3000,
                allowToastClose:false
            })
        @endif ()
    </script>
    <script>
    $( document ).ready(function() {
        $('#model').html('<option value="">Select Model</option>');
        var year = $('#year').val();
		//alert("year:"+year);
		var make = $('#make').val();
		//alert("make:"+make);
        $('#model').html('<option value="">Select Model</option>');
       
		if((year!="")&&(make!="")){
		
		
			$.ajax({
				url: "{{ route('vendor.displaymodel') }}",
				type: 'post',
				data: {
					_token: '{{ csrf_token() }}',
					'year': year,
					'make': make
				},
				success: function(data) {
					res = JSON.parse(data);
                    result = res[0];
                    var myselect = $('<select>');
                    $('#model').html('<option value="">Select Model</option>');          
                    $.each(result, function(index, key) {
                      
                        myselect.append($('<option></option>').val($.trim(key.model)).html(key.model));
                    });
                  
                    $('#model').append(myselect.html());
                    var sel="{!!request()->input('model')!!}"
                    
                    $('#model').find('option[value="'+sel+'"]').attr('selected','selected');
                    

					
					
				}
			});
		}
        $('#year').bind('input propertychange',function() {
		//alert("test");
       
		var year = $(this).val();
		//alert("year:"+year);
		var make = $('#make').val();
		//alert("make:"+make);
        $('#model').html('<option value="">Select Model</option>');
		if((year!="")&&(make!="")){
		
		
			$.ajax({
				url: "{{ route('vendor.displaymodel') }}",
				type: 'post',
				data: {
					_token: '{{ csrf_token() }}',
					'year': year,
					'make': make
				},
				success: function(data) {
					res = JSON.parse(data);
                    result = res[0];
                    var myselect = $('<select>');
                    $('#model').html('<option value="">Select Model</option>');          
                    $.each(result, function(index, key) {
                      
                        myselect.append($('<option></option>').val($.trim(key.model)).html(key.model));
                    });
                    $('#model').append(myselect.html());
					
					
				}
			});
		}

	});
	$('#make').bind('input propertychange',function() {
		
		var make = $(this).val();
		var year = $('#year').val();
        $('#model').html('<option value="">Select Model</option>');
		if((year!="")&&(make!="")){
		
		
			$.ajax({
				url: "{{ route('vendor.displaymodel') }}",
				type: 'post',
				data: {
					_token: '{{ csrf_token() }}',
					'year': year,
					'make': make
				},
				success: function(data) {
					res = JSON.parse(data);
                    result = res[0];
                    var myselect = $('<select>');
                    $('#model').html('<option value="">Select Model</option>');
                    $.each(result, function(index, key) {
      
	                myselect.append($('<option></option>').val($.trim(key.model)).html(key.model));
                 });
                $('#model').append(myselect.html());
                   
					
					
				}
			});
		}

	});
});
    </script>
    @yield('script')
    <div class="main-navbar-backdrop"></div>
</body>

</html>
