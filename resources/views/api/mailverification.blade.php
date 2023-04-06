<!DOCTYPE html>
<html>
<head>
	   <title>Email Verification</title>
	   <meta charset="utf-8">
	  <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
      
</head>
<body>
	<div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;">
		<div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">
			<img src="splash-logo.png" style="width:100px;float: right;margin-top: 0 auto;">
			<h3 style="padding-top:40px; line-height: 30px;">Welcome to <span style="font-weight: 900;font-size: 35px;color: #F44C0D; display: block;">{{ env('APP_NAME') }}</span></h3>
			<p>Hello {{ $user_data['name'] }}</p>
			<p>Thank you for registering on <span style="font-size:20px;"><b>{{ env('APP_NAME') }}</b></span></p>
			<p>Your have successfully an account in {{ env('APP_NAME') }} App. Lets Explore together!</p>
			<p style="text-align: center;">
			<a href="{{ route('api.verifyEmail', $token) }}" style="height: 50px;
                                width: 300px;
                                background: rgb(253,179,2);
                                background: linear-gradient(0deg, rgba(253,179,2,1) 0%, rgba(244,77,9,1) 100%);
                                text-align: center;
                                font-size: 18px;
                                color: #fff;
                                border-radius: 12px;
                                display: inline-block;
                                line-height: 50px;
                                text-decoration: none;
                                text-transform: uppercase;
                                font-weight: 600;">Verify Email </a></p>

    
    	<p style="font-size:20px;">Thank you!</p>
    	<li style="font-size:20px;list-style: none;">sincerly</li>
    	<li style="list-style: none;"><b>Team {{ env('APP_NAME') }}</b></li>

    	<ul style="list-style: none;padding: 0;box-sizing: border-box; margin: 4px 0;"> 


    		<li style="vertical-align: top;display: inline-block;"><b style="font-size:10px;margin-bottom: 10px;">Download the App on</b></li>
    			<li style="display: inline-block;"><a href="#"><img src="playstore.png" height="35px"></a></li>
    				<li style="display: inline-block;"><a href="#"><img src="appstore.png" style="height:35px;"></a></li>
    </ul>
    	
    	
		</div>
           <footer style="height:25px;width:100%;background: #F44C0D;"><span style="padding-left: 10px;"> copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }}-All right reserverd</span></footer>
	</div>
</body>
</html>