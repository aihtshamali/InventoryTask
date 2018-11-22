<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory System</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="{!! asset('css/app.css') !!}"> --}}
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- font Awesome CSS -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

        <!-- Main Styles CSS -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('css/datepicker.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <!-- Styles -->
        @yield('styleTags')
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    </head>
    <body>

      <div class="container">
        @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
        @endif
      </div>

        @yield('content')
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/clone-form-td.js')}}"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script>

        $(function() {
        setTimeout(function() {
          $('.alert').slideUp('slow');
          }, 2000);
        });

        </script>
        @yield('scriptTags')
    </body>
</html>
