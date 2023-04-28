@extends('layouts.main')
@section('content')            
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('status.title') }}</h1>

                @auth
                <div>
                    <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('status.create_status') }}</a>
                </div>
                @endauth
            
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('status.title_ID') }}</th>
                        <th>{{ __('status.title_name') }}</th>
                        <th>{{ __('status.title_creation_date') }}</th>
                        @auth
                        <th>{{ __('status.title_actions') }}</th>
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
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                            {{ __('status.change') }}                         </a>                          
                            <a data-confirm="{{ __('status.are_you_sure') }}" data-method="delete" class="text-red-600 hover:text-red-900"
                               href="{{ route('task_statuses.destroy', $status) }}" style="margin-left:10px">
                               {{ __('status.delete') }}                        </a>                        
                        </td>
                        @endauth
                    </tr> 
                  @endforeach              
                </tbody>
            </table>
            {{ $taskStatuses->links() }}
        </div>
    </div>
</section>
@endsection