@extends('layouts.main')
@section('content')            
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Метки</h1>
            @auth
            <div>
                <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Создать метку            </a>
            </div>
            @endauth

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Описание</th>
                        <th>Дата создания</th>
                        @auth
                        <th>Действия</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labels as $label)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>
                        @auth
                        <td>      
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">
                                Изменить                        </a>    
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                               href="{{ route('labels.destroy', $label) }}" style="margin-left:10px">
                                Удалить                        </a>            
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $labels->links() }}
        </div>
    </div>
</section>
@endsection