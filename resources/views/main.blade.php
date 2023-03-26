@extends('layouts.main')
@section('content')            
            <section class="bg-white">
                <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl">
                            Привет от Хекслета! </h1>
                        <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                            Это простой менеджер задач на Laravel </p>
                        <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            <a href="https://github.com/Marre-86/php-project-57" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" target="_blank">
                                Исходный код </a>
                         <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            <a href="https://ru.hexlet.io/u/artem_pokhiliuk" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" target="_blank">
                                Об авторе </a>
                        </div>  
                        </div>  
                    </div>
                </div>
            </section>
@endsection
