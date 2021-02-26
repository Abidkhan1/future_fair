<!DOCTYPE html>
<html lang="en" >


<head>

  @include('dashboard_partials._header')
  @yield('outer_style')

    <meta charset="UTF-8">
    <title>Private Messaging</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
    <link rel="chat icon" href="{{ asset('favicon.ico') }}" >


    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        window.auth = {!! auth()->user() !!}
    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Styles -->
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        html {
            overflow: scroll;
        }
    </style>











</head>
<body style="height:900px; background-color: #f4f6f9;">


   @include('dashboard_partials._topbar')
   @include('dashboard_partials._sidebar')

 <!-- Content Wrapper. Contains page content -->


   <!-- /.content-header -->

   <!-- Main content -->


       <div id="app">




         <!-- <div class="wrapper1"  style=" padding-top: 0px; position: absolute; background-color: white; margin-top: 0px; margin-left: 130px;"> -->
         <!-- <div style="height:600px; background-color: white;"> -->

             <private-chat-component></private-chat-component>

         <!-- </div> -->




       </div>




 <aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
 </aside>
 <!-- @include('dashboard_partials._footer') -->

<!-- </div> -->
<!-- vue app -->


  <!-- <div style="width: 2000px; height: 2000px; overflow:auto;"> -->



<!-- </div> -->

<!-- partial -->

<div style="margin-top: 795px;">
@include('dashboard_partials._footer')
</div>
</body>
</html>
