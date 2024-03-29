<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            @yield('title')
                        </h2>
                    </div>
                </header>

            <!-- Page Content -->
            <main>
                <div id="modalDiv" hidden>
                    <div id="loadingModalOverlay" style="position: absolute; top:0; left:0; bottom:0; right:0; background-color: black; opacity: .2; z-index: 9;">

                    </div>
                    <div id="messageBox" style="background-color: white; height: 400px; width: 700px; margin: auto; position: absolute; top:25%; left:30%; z-index: 10; padding: 10px">
                        <button class="sureVkl pointer-events-auto ml-8 rounded-md bg-blue-600 py-2 px-3 text-[0.8125rem] font-semibold leading-5 text-white hover:bg-blue-500">sure vkl</button>
                        <button  class="noNoButton pointer-events-auto ml-8 rounded-md bg-red-600 py-2 px-3 text-[0.8125rem] font-semibold leading-5 text-white hover:bg-red-500">đéo</button>
                    </div>
                </div>
                @yield('content')
            </main>
            @yield('scripts')
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-post', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
