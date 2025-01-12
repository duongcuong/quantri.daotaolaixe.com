<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>{{ config('app.name') }} | @yield('title')</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('/') }}backend/assets/images/favicon-32x32.png" type="image/png" />
  <!-- loader-->
  <link href="{{ asset('/') }}backend/assets/css/pace.min.css" rel="stylesheet" />
  <script src="{{ asset('/') }}backend/assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('/') }}backend/assets/css/bootstrap.min.css" />
  <!-- Icons CSS -->
  <link rel="stylesheet" href="{{ asset('/') }}backend/assets/css/icons.css" />
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ asset('/') }}backend/assets/css/app.css" />
</head>

<body class="bg-login">
  <!-- wrapper -->
  <div class="wrapper">
    @yield('content')
  </div>
  <!-- end wrapper -->
</body>
<!-- jQuery -->
<script src="{{ asset('/') }}backend/assets/js/jquery.min.js"></script>
@include('auth.toast')
@stack('js')

</html>
