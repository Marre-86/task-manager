@extends('layouts.main')
@section('content')

<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Создать задачу</h1>

            <form method="POST" action="{{ route('tasks.store') }}" accept-charset="UTF-8" class="w-50">
              @csrf
                <div class="flex flex-col">
                    @include('task.form')
                    <div class="mt-2">
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" value="Создать">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection