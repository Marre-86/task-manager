<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />

        <title>Менеджер задач</title>
        
        <!-- Scripts -->
        @vite(['resources/js/app.js', 'resources/css/app.css'])

    </head>
    <body>
        <div id="app">
            <header class="fixed w-full"  style="position: relative;">
                <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                        <a href="/" class="flex items-center">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                        </a>



                        @if (Route::has('login'))
                        <div class="flex items-center lg:order-2">
                            @auth

                            <!-- убрать нижеследующий блок после сдачи проекта на Хекслете  -->
                                <div class="flex items-center lg:order-2">
                                    <a href="route('logout')" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            <!-- вот досюда убрать  -->

                            @include('layouts.navigation')
                            @else
                            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Вход
                            </a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Регистрация
                            </a>
                            @endif
                            @endauth
                        </div>
                        @endif


                        <div class="items-center w-full lg:flex lg:w-auto lg:order-1">
                            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                                <li>
                                    <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Задачи </a>
                                </li>
                                <li>
                                    <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Статусы </a>
                                </li>
                                <li>
                                    <a href="{{ route('labels.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Метки </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
            @if (session()->has('flash_notification'))
                <div style="position: absolute; top: 12%; left: 0;  width: 100%; text-align: center">
                    @include('flash::message')    
                </div>
            @endif
            </div>
        <div  style="margin-top: -60px">
            @yield('content')
        </div>
    </body>
</html>   