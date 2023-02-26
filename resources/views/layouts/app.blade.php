<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="PQp8vbwNm9fVXlHUDDRACdrfTGcYVxo9wH4K8nIc">
        <meta name="csrf-param" content="_token">
        <title>Менеджер задач</title>
        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header class="fixed w-full">
                <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                        <a href="/" class="flex items-center">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                        </a>
                        <div class="flex items-center lg:order-2">
                            <a href="https://php-task-manager-ru.hexlet.app/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Вход
                            </a>
                            <a href="https://php-task-manager-ru.hexlet.app/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Регистрация
                            </a>
                        </div>
                        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                                <li>
                                    <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Задачи </a>
                                </li>
                                <li>
                                    <a href="https://php-task-manager-ru.hexlet.app/task_statuses" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Статусы </a>
                                </li>
                                <li>
                                    <a href="https://php-task-manager-ru.hexlet.app/labels" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                        Метки </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            @yield('content')
        </div>
    </body>
</html>        