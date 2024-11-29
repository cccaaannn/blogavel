<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A simple blog application.">

    <title>@yield('title', __('generic.blogavel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

    <!-- Fix fouc -->
    <style>
        body {
            visibility: hidden;
        }
    </style>
    <noscript>
        <style>
            body {
                visibility: visible;
            }
        </style>
    </noscript>

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('icons/logo.png') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ request()->getHost() }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:image" content="{{ asset('icons/logo.png') }}">

    <meta name="twitter:title" content="{{ __('generic.blogavel') }}">
    <meta property="og:title" content="{{ __('generic.blogavel') }}">

    @hasSection('layout_open_graph_description')
        @yield('layout_open_graph_description')
    @else
        <meta name="twitter:description" content="{{ __('generic.blogavel_description') }}">
        <meta property="og:description" content="{{ __('generic.blogavel_description') }}">
    @endif

    <!-- Resources -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full h-full flex flex-col">
    <nav
        class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 h-22">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">

            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/logo.png" class="h-8" alt="Blogovel Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    {{ __('generic.blogavel') }}
                </span>
            </a>

            <div class="flex gap-3 items-center">
                @auth
                    <a href="/users/me"
                        class="md:hidden relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">

                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::disk('minio')->url('public/avatars/' . Auth::user()->avatar) }}"
                                alt="User Avatar" class="w-10 h-10 rounded-full">
                        @else
                            <span class="font-medium text-gray-600 dark:text-gray-300">{{ Auth::user()->name[0] }}</span>
                        @endif
                    </a>
                @endauth

                <button type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    id="navbar-toggle">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="hidden w-full md:block md:w-auto" id="navbar-menu">
                <ul
                    class="font-medium flex items-center flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li class="md:w-auto w-full">
                        <a href="/"
                            class="block py-2 px-3 rounded md:p-0 
                            {{ Request::is('/') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">
                            {{ __('generic.home') }}
                        </a>
                    </li>
                    <li class="md:w-auto w-full">
                        <a href="/posts"
                            class="block py-2 px-3 rounded md:p-0 
                            {{ Request::is('posts') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">
                            {{ __('generic.posts') }}
                        </a>
                    </li>

                    @auth
                        <li class="md:hidden block w-full">
                            <a href="/posts/me"
                                class="block py-2 px-3 rounded md:p-0 
                            {{ Request::is('posts/me') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">
                                {{ __('generic.my_posts') }}
                            </a>
                        </li>
                        <li class="md:hidden block w-full">
                            <form action="/auth/logout" method="POST" class="py-2">
                                @csrf
                                <button type="submit"
                                    class="w-full px-3 flex text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    {{ __('generic.logout') }}
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="md:w-auto w-full">
                            <a href="/auth/login"
                                class="block py-2 px-3 rounded md:p-0 
                                {{ Request::is('auth/login') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">
                                {{ __('generic.login') }}
                            </a>
                        </li>
                        <li class="md:w-auto w-full">
                            <a href="/auth/register"
                                class="block py-2 px-3 rounded md:p-0 
                            {{ Request::is('auth/register') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">
                                {{ __('generic.register') }}
                            </a>
                        </li>
                    @endauth

                    <li class="md:w-auto w-full">
                        <div class="flex justify-end my-2">
                            <form action="{{ url('locale') }}" method="POST">
                                @csrf
                                <select name="locale" class="select" onchange="this.form.submit()">
                                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                                        {{ __('generic.english') }}
                                    </option>
                                    <option value="tr" {{ app()->getLocale() == 'tr' ? 'selected' : '' }}>
                                        {{ __('generic.turkish') }}
                                    </option>
                                </select>
                            </form>
                        </div>
                    </li>

                    @auth
                        <li class="w-auto hidden md:block relative">
                            <div class="cursor-pointer relative inline-flex items-center justify-center w-12 h-12 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
                                onclick="document.getElementById('profile-dropdown').classList.toggle('hidden')">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Storage::disk('minio')->url('public/avatars/' . Auth::user()->avatar) }}"
                                        alt="User Avatar" class="rounded-full">
                                @else
                                    <span
                                        class="font-medium text-gray-600 dark:text-gray-300 text-lg">{{ Auth::user()->name[0] }}</span>
                                @endif
                            </div>

                            <div id="profile-dropdown"
                                class="hidden right-1 top-14 z-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                                </div>

                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="/posts/me"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            {{ __('generic.my_posts') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/users/me"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            {{ __('generic.profile') }}
                                        </a>
                                    </li>
                                </ul>

                                <form action="/auth/logout" method="POST" class="py-2">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 flex text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        {{ __('generic.logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="w-full h-full flex flex-grow justify-center">
        <div class="w-full max-w-screen-xl px-4 py-6">
            @yield('layout_content')
        </div>
    </div>

    <script type="module">
        $('#navbar-toggle').click(() => {
            const selectMenu = $('#navbar-menu');
            if (selectMenu.hasClass('hidden')) {
                selectMenu.removeClass('hidden');
            } else {
                selectMenu.addClass('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
