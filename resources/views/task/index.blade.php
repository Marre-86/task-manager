@extends('layouts.main')
@section('content')            
<section class="bg-white">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <div>
                <h1 style="display: inline-block;">{{ __('task.title') }}</h1>
                <div style="display: inline-block; position: fixed; right: 0; padding-right: 40px; padding-top: 20px">
                    @auth
                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    {{ __('task.create_task') }}            </a>
                    @endauth
                </div>
            </div>
            <div class="w-full flex items-center">
                <div>
                    {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
                        <div class="flex">
                            <div>
                                {{Form::select('filter[status_id]', $statuses, $filter['status_id'] ?? null, ['placeholder' =>  __('task.title_status'), 'class' => 'rounded border-gray-300'])}}
                            </div>
                            <div>
                                {{Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' =>  __('task.title_creator'), 'class' => 'ml-2 rounded border-gray-300'])}}
                            </div>
                            <div>
                                {{Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' =>  __('task.title_assigned_to'), 'class' => 'ml-2 rounded border-gray-300'])}}
                            </div>
                            <div>
                                {{ Form::submit( __('task.apply'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2']) }}
                            </div>                
                        </div>
                    {{Form::close()}}
                </div>

            </div>
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('task.title_ID') }}</th>
                        <th>{{ __('task.title_status') }}</th>
                        <th>{{ __('task.title_task_name') }}</th>
                        <th>{{ __('task.title_creator') }}</th>
                        <th>{{ __('task.title_assigned_to') }}</th>
                        <th>{{ __('task.title_creation_date') }}</th>
                        @auth
                        <th>{{ __('task.title_actions') }}</th>
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
                            {{ __('task.change') }}                        </a>
                            @if (Auth::id() === $task->created_by->id)                     
                            <a data-confirm="{{ __('task.are_you_sure') }}" data-method="delete" class="text-red-600 hover:text-red-900"
                               href="{{ route('tasks.destroy', $task) }}" style="margin-left:10px">
                               {{ __('task.delete') }}                        </a>
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