<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link href="{{ asset('css/login/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<script src="{{ asset('css/login/bootstrap.min.js') }}"></script>
<script src="{{ asset('css/login/jquery.min.js') }}"></script>
<!------ Include the above in your HEAD tag ---------->

<title>{{ config('app.name', 'Laravel') }}</title>

   <!--Made with love by Mutiullah Samim -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" >

   <script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/sweetalert2.all.min.js') }}" defer></script>

   <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
   <meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    body{
        background-image: url('{{ asset('images/finance.jpg') }}');
    }

</style>
<script>
   $(document).ready(function() {
        $("#Login-form").submit(function(){

                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              //  alert("Sadasd");
                var username=$("#username").val();
                var password=$("#password").val();
                if(username==''){
                   Swal.fire({
										title: "Warning !",
										text: "Please enter username",
										icon: "error"
									}).then(function() {

                                        $("#username").focus();
                                        Swal.close();
									});


                }else if(password==''){
                    Swal.fire({
										title: "Warning !",
										text: "Please enter password",
										icon: "error"
									}).then(function() {
                                        $("#password").focus();
                                        Swal.close();
									});
                }else{
                Swal.fire({
                    title: 'Verifying...',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                    });
                    Swal.showLoading();
                $.ajax({
                    url: "{{route('user_login')}}",
                    type: "POST",
                    data: $('#Login-form').serialize(),
                    success: function( response ) {
                   // alert(response);

                    if(response.trim()=='ok'){
                             Swal.fire({
										title: "Success!",
										text: "Login Successfully!",
										icon: "success"
									}).then(function() {
                                      //  clearHistory();
                                       window.location.href ="{{url('/home')}}";
                                        Swal.close();
									});
                    }else{
                        Swal.fire({
										title: "Warning!",
										text: response,
										icon: "error"
									}).then(function() {
                                        $("#password").val('');
                                        $("#password").focus();
                                         Swal.close();
									});
                    }


                    }
                });
            }
            return false;
	    });


    });
    </script>
</head>
<body>



    <div class="login-page">
        <div class="form ">
        <form name="ajax-contact-form" id="Login-form" method="post" >
                @csrf
            <h3>LOG-IN ACCOUNT </h3>
            <hr>
            <b style="color:#818181"> Username</b>
            <input type="text" name="username" id="username" placeholder="Enter username"/>
            <b style="color:#818181"> Password</b>
            <input type="password" name="password" id="password" placeholder="Enter password"/>
            <hr>
            <button type="submit">login</button>
          </form>
        </div>
      </div>

</body>
</html>
