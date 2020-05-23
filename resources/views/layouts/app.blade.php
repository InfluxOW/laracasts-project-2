<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="theme-light bg-page h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-header border-b-2 border-default mb-4 py-1">
            <div class="mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between ml-4">
                    <a href="{{ route('main') }}">
                        <img src="{{ asset('images/birdboard_theme-light.png') }}" width="320px" id="logo">
                    </a>

                    <div>
                        <div class="flex items-center ml-auto mr-4">
                            @guest
                                <a class="no-underline text-muted text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="no-underline text-muted text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <theme-switcher></theme-switcher>

                                <dropdown align="right" width="100px">
                                    <template v-slot:trigger>
                                        <button
                                            class="flex items-center text-default no-underline text-sm"
                                            v-pre
                                        >
                                        <img src="{{ Auth::user()->getAvatar() }}" alt="" class="rounded-full w-8 mr-2">
                                            {{ Auth::user()->name }}
                                        </button>
                                    </template>

                                    {!! Form::open(['url' => route('logout'), 'id' => 'logout-form']) !!}
                                        {!! Form::button('Logout', ['type' => 'submit', 'class' => 'dropdown-menu-link w-full text-center']) !!}
                                    {!! Form::close() !!}
                                </dropdown>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="mx-auto py-4 container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(e) {
          if (!e.target.matches('.dropbtn')) {
          var myDropdown = document.getElementById("myDropdown");
            if (myDropdown.classList.contains('show')) {
              myDropdown.classList.remove('show');
            }
          }
        }
        </script>
    @stack('scripts')
</body>
</html>
