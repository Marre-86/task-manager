@extends('layouts.main')
@section('content')            
<section class="bg-white">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Задачи</h1>
            <div class="w-full flex items-center">
                <div>
                    <form method="GET" action="https://php-task-manager-ru.hexlet.app/tasks" accept-charset="UTF-8" class="">
                        <div class="flex">
                            <div>
                                <select class="rounded border-gray-300" name="filter[status_id]"><option selected="selected" value="">Статус</option><option value="1">новая</option><option value="2">завершена</option><option value="3">выполняется</option><option value="4">в архиве</option></select>
                            </div>
                            <div>
                                <select class="ml-2 rounded border-gray-300" name="filter[created_by_id]"><option selected="selected" value="">Автор</option><option value="1">Пахомова Аркадий Дмитриевич</option><option value="2">Сидорова Лилия Максимовна</option><option value="3">Дмитриеваа Дина Алексеевна</option><option value="4">Тарасова Зинаида Максимовна</option><option value="5">Авдееваа Лилия Андреевна</option><option value="6">Зайцева Валерий Романович</option><option value="7">Лаврентий Андреевич Сафонова</option><option value="8">Марк Львович Егорова</option><option value="9">Зиновьева Диана Борисовна</option><option value="10">Евсеев Григорий Дмитриевич</option><option value="11">Добрыня Львович Стрелкова</option><option value="12">Фролова Инна Алексеевна</option><option value="13">Игнатьеваа Валерия Сергеевна</option><option value="14">Василиса Дмитриевна Смирнова</option><option value="15">Яков Владимирович Волков</option></select>
                            </div>
                            <div>
                                <select class="ml-2 rounded border-gray-300" name="filter[assigned_to_id]"><option selected="selected" value="">Исполнитель</option><option value="1">Пахомова Аркадий Дмитриевич</option><option value="2">Сидорова Лилия Максимовна</option><option value="3">Дмитриеваа Дина Алексеевна</option><option value="4">Тарасова Зинаида Максимовна</option><option value="5">Авдееваа Лилия Андреевна</option><option value="6">Зайцева Валерий Романович</option><option value="7">Лаврентий Андреевич Сафонова</option><option value="8">Марк Львович Егорова</option><option value="9">Зиновьева Диана Борисовна</option><option value="10">Евсеев Григорий Дмитриевич</option><option value="11">Добрыня Львович Стрелкова</option><option value="12">Фролова Инна Алексеевна</option><option value="13">Игнатьеваа Валерия Сергеевна</option><option value="14">Василиса Дмитриевна Смирнова</option><option value="15">Яков Владимирович Волков</option></select>
                            </div>
                            <div>
                                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit" value="Применить">
                            </div>                
                        </div>
                    </form>
                </div>
                <div class="ml-auto">
                    @auth
                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                        Создать задачу            </a>
                    @endauth
                </div>
            </div>
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>ID</th>
                        <th>Статус</th>
                        <th>Имя</th>
                        <th>Автор</th>
                        <th>Исполнитель</th>
                        <th>Дата создания</th>
                        @auth
                        <th>Действия</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->status->name }}</td>
                        <td>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td>{{ $task->created_by->name }}</td>
                        <td>{{ $task->assigned_to->name ?? '' }}</td>
                        <td>{{ $task->created_at->format('d.m.Y') }}</td>
                        @auth
                        <td>      
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                Изменить                        </a>
                            @if (Auth::id() === $task->created_by->id)                     
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                               href="{{ route('tasks.destroy', $task) }}" style="margin-left:10px">
                                Удалить                        </a>
                            @endif                     
                        </td>
                        @endauth
                    </tr>
                    @endforeach     
                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>
    </div>
</section>
@endsection