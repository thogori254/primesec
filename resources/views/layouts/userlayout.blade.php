<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div id="minion">
{{--        @include('partials.login')--}}

        <div class="my-wrapper">
            @include('includes.usernav')

            <main class="py-4 appWrapper">

{{--                <div class="float-right" style="margin-top: -5%; position: -webkit-sticky;--}}
{{--                            position: sticky; top:0;">--}}

{{--                    <div class="dropdown">--}}
{{--                        @auth--}}

{{--                            <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">--}}
{{--                                    <div class="user_icon">--}}
{{--                                    <i class="fa fa-user fa-2x"></i>--}}
{{--                                    </div>--}}

{{--                            </a>--}}
{{--                            <div class="dosha_dropdown-menu dosha_dropdown-menu-right" aria-labelledby="userSettings">--}}

{{--                                        <h6 style="text-align: center">{{ Auth::user()->name }}</h6>--}}



{{--                                    <a  href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                        document.getElementById('logout-form').submit();">--}}
{{--                                        <h7>Logout</h7>  <i class="fas fa-sign-out-alt fa-2x"></i>--}}

{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}


{{--                            </div>--}}

{{--                        @endauth--}}

{{--                        @guest--}}
{{--                        <button class="btn_subscribe" data-toggle="modal"--}}
{{--                           data-target="#loginModal"> SUBSCRIBE </button>--}}

{{--                            @endguest--}}
{{--                    </div>--}}
{{--            </div>--}}
                @yield('content')
            </main>

        </div>
        @include('includes.footer')
    </div>
    @yield('scripts')

</body>
</html>
