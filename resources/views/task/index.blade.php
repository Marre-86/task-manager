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
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-dashed text-left">
                        <td>1</td>
                        <td>в архиве</td>
                        <td>
                            <a class="text-blue-600 hover:text-blue-900" href="https://php-task-manager-ru.hexlet.app/tasks/1">
                                Исправить ошибку в какой-нибудь строке
                            </a>
                        </td>
                        <td>Евсеев Григорий Дмитриевич</td>
                        <td>Игнатьеваа Валерия Сергеевна</td>
                        <td>26.02.2023</td>
                        <td>
                                            </td>
                    </tr>           
                </tbody>
            </table>
            <div class="mt-4">
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                        « Previous
                        </span>
                        <a href="https://php-task-manager-ru.hexlet.app/tasks?page=2" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        Next »
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 leading-5">
                                Showing
                                <span class="font-medium">1</span>
                                to
                                <span class="font-medium">15</span>
                                of
                                <span class="font-medium">16</span>
                                results
                            </p>
                        </div>
                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                 <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </span>                  
                                <span aria-current="page">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>
                                </span>
                                <a href="https://php-task-manager-ru.hexlet.app/tasks?page=2" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Go to page 2">
                                        2
                                </a>
                                <a href="https://php-task-manager-ru.hexlet.app/tasks?page=2" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next &amp;raquo;">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection