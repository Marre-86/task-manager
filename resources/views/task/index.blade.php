@extends('layouts.main')
@section('content')            
<section class="bg-white">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <div>
                <h1 style="display: inline-block;">Задачи</h1>
                <div style="display: inline-block; position: fixed; right: 0; padding-right: 40px; padding-top: 20px">
                    @auth
                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                        Создать задачу            </a>
                    @endauth
                </div>
            </div>
            <div class="w-full flex items-center">
                <div>
                    <form method="GET" action="{{ route('tasks.index', array('filter[status_id]' => 1, 
                                                                             'filter[created_by_id]' => 'here',
                                                                             'filter[assigned_to_id]' => 'there')) }}" accept-charset="UTF-8" class="">
                        <div class="flex">
                            <div>
                                <select class="rounded border-gray-300" name="filter[status_id]">
                                    @if (isset($filter) && isset($filter['status_id']))
                                        <option value="">Статус</option>
                                    @else
                                        <option selected="selected" value="">Статус</option>
                                    @endif
                                  @foreach ($statuses as $status)
                                    @if (isset($filter) && ($status->id == $filter['status_id']))
                                    <option selected="selected" value="{{ $status->id }}">{{ $status->name }}</option>
                                    @else
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                            <div>
                                <select class="ml-2 rounded border-gray-300" name="filter[created_by_id]">
                                    @if (isset($filter) && isset($filter['created_by_id']))
                                        <option value="">Автор</option>
                                    @else
                                        <option selected="selected" value="">Автор</option>
                                    @endif
                                  @foreach ($users as $user)
                                    @if (isset($filter) && ($user->id == $filter['created_by_id']))
                                    <option selected="selected" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                            <div>
                                <select class="ml-2 rounded border-gray-300" name="filter[assigned_to_id]">
                                    @if (isset($filter) && isset($filter['assigned_to_id']))
                                        <option value="">Исполнитель</option>
                                    @else
                                        <option selected="selected" value="">Исполнитель</option>
                                    @endif
                                  @foreach ($users as $user)
                                    @if (isset($filter) && ($user->id == $filter['assigned_to_id']))
                                    <option selected="selected" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                            <div>
                                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit" value="Применить">
                            </div>                
                        </div>
                    </form>
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