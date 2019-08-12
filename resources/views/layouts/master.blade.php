<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Amila Lakmal Hapuarachchi">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>LAYOUTindex - Forum</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="{{asset('assets/css/blog-post.css')}}" rel="stylesheet">
  <link href="{{asset('assets/plugins/bootstrap-tagsinput-latest/bootstrap-tagsinput.css')}}" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @stack('moreCss')
</head>

<body>

  <!-- header section -->
  @include('includes.header')

  @yield('content')
  <!-- Page Content -->
  @include('includes.footer')

  <!-- Footer -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  <script type="text/javascript" src="{{asset('assets/plugins/bootstrap-tagsinput-latest/bootstrap-tagsinput.min.js')}}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


  </script>
  
  <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript" src="{{asset('assets/js/post.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/user.js')}}"></script>
    @stack('moreJs')
</body>

</html>
