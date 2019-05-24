<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script
            defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js"
            integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH"
            crossorigin="anonymous"></script>
</head>
<body class="bg-grey-lightest h-screen antialiased">
@include('sweetalert::alert')
<div id="app">
    <nav class="bg-ultrablue mb-8 py-6">
        <div class="container mx-auto px-6 md:px-0">
            <div class="flex items-center justify-center">
                <div class="mr-6">
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-white no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="flex-1 text-right">
                    <a class="no-underline hover:underline text-grey-lightest text-sm p-3" href="{{ route('jobs') }}">Jobs</a>
                    <a
                            class="no-underline hover:underline text-grey-lightest text-sm p-3"
                            href="{{ route('companies') }}">Companies</a>
                    @if(auth() && auth()->user() && auth()->user()->is_admin)
                        <a
                                class="no-underline hover:underline text-grey-lightest text-sm p-3"
                                href="{{ route('documents') }}">Documents</a>
                    @endif
                    @guest
                        <a
                                class="no-underline hover:underline text-grey-lightest text-sm p-3"
                                href="{{ route('login') }}">Login</a>
                    @else
                        <a
                                href="{{ route('logout') }}"
                                class="no-underline hover:underline text-grey-lightest text-sm p-3 font-bold"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
