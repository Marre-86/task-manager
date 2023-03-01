@extends('layouts.main')
@section('content')            
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Статусы</h1>

                @auth
                <div>
                    <a href="task_statuses/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Создать статус</a>
                </div>
                @endauth
            
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Дата создания</th>
                        @auth
                        <th>Действия</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                  @foreach ($taskStatuses as $status)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->created_at->format('d.m.Y') }}</td>
                        @auth
                        <td>                            
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="https://php-task-manager-ru.hexlet.app/task_statuses/1">
                                Удалить                        </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                                Изменить                        </a>                            
                        </td>
                        @endauth
                    </tr> 
                  @endforeach              
                </tbody>
            </table>    
        </div>
    </div>
</section>
@endsection