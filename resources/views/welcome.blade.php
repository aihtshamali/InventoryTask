<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        {{-- <link rel="stylesheet" href="{!! asset('css/app.css') !!}"> --}}
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- font Awesome CSS -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

        <!-- Main Styles CSS -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('css/datepicker.min.css')}}" rel="stylesheet">
        <!-- Styles -->
        <style>
        .btn-outline-dark {
          color: #fff;
          background-color: #343a40;
          border-color: #343a40;
          }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Inventory
                </div>
                <a href="{{route('invoice.index')}}" class="btn btn-outline-dark btn">Invoice</a>

            </div>
        </div>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/clone-form-td.js')}}"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
    </body>
</html>
