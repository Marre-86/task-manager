@extends('layouts.main')
@section('content')

<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('task.create_task') }}</h1>

            {{ Form::model($task, ['route' => 'tasks.store'], ['class' => 'w-50']) }}
                @include('task.form')
                    <div class="mt-2">
                        {{ Form::submit(__('task.create'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                    </div>
                </div>
            </form>
           
        </div>
    </div>
</section>
@endsection