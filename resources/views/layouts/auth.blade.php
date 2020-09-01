<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{asset('assets/hafecs_oc.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>{{(Request::is('login') == 'login' ) ? 'Login' : 'Daftar' }}</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{asset('assets/hafecs_oc.png')}}">
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/css-hamburgers/hamburgers.min.cs')}}s">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/regis/css/main.css')}}">
    <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
  <script type="text/javascript"  src="{{asset('js/sweetalert2.min.js')}}"></script>

<!--===============================================================================================-->
</head>

<style>
  * {
    box-sizing: border-box;
  }
  body {
    background-color: #F9FAFD;
  }

  @media (min-width:767px) {
    .mr-5-xs {
      margin-right: 5%;
    }
  }

  @media (max-width:767px) {
    .right-xs {
      float: right;
    }

    .container-login100 {
      width: 127%;
      padding: 34px;
    }
  }

  .feather-16{
      width: 16px;
      height: 16px;
  }

  .feather-24{
      width: 24px;
      height: 24px;
  }

  .feather-32{
      width: 32px;
      height: 32px;
  }

  .icon-form {
    right: auto; 
    padding-left: 20px; 
    padding-bottom: 25px;
  }

  .shadow {
      box-shadow: 0 0.2rem 2rem #E8EAEC !important;
  }

  .shadow-sm {
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.15) !important;
  }

  .shadow-md {
      box-shadow: 0 0.2rem 2rem rgba(0, 0, 0, 0.15) !important;
  }
  .shadow-lg {
      box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  }

  .btn {
    width: 7rem;
  }

  .btn-primary {
    background-color: #4F92F2;
      border-color: #4F92F2;
  }

  .btn-primary:hover {
    transform: translateY(-5px);
  }

  .btn-light:hover {
    background-color: #fff;
      border-color: #fff;
      transform: translateY(-5px);
  }

  .btn-light {
    background-color: #fff;
      border-color: #fff;
  }

  .br-50 {
    border-radius: 50%;
  }

  .hidden {
    display: none;
  }

  @media (max-width:767px) {
      .hidden-xs {
          display: none!important
      }
  }

  @media (min-width:768px) and (max-width:991px) {
      .hidden-sm {
          display: none!important
      }
  }

  @media (min-width:992px) and (max-width:1199px) {
      .hidden-md {
          display: none!important
      }
  }

  @media (min-width:1200px) {
      .hidden-lg {
          display: none!important
      }
  }
  
  .alert-danger {
    border: unset;
  }
</style>
<body>
@include('sweet::alert')

@yield('content')

<div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('assets/regis/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('assets/regis/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/regis/js/main.js')}}"></script>
  <script>
      feather.replace();

      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }

      function  check_email(val) {
        if(!validateEmail(val)) {
          $("#email-alert-text").fadeOut();
        } else {
          $.ajax({
            type: 'POST',
            url : '{{asset('cek_email')}}',
            data: {
                  "_token": "{{ csrf_token() }}",
                  "val": val,
              },
            success: function(data) {
              if(val == '') {
                $("#email-alert-icon").fadeOut();
              } else {
                if(data == 0) {
                  $("#email-alert-icon").fadeIn();
                  $("#email-alert-text").fadeOut();
                } else {
                  $("#email-alert-icon").fadeOut();
                  $("#email-alert-text").fadeIn();
                }
              }
            }
          })
        }
      }

      function open_pass() {
        $("#form-pass").attr('type', 'text');
        $("#icon-pass").attr('class', 'fa fa-eye-slash');
        $("#icon-pass").attr('onclick', 'close_pass()');
      }

      function close_pass() {
        $("#form-pass").attr('type', 'password');
        $("#icon-pass").attr('class', 'fa fa-eye');
        $("#icon-pass").attr('onclick', 'open_pass()');
      }
    </script>
</body>
</html>