@if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li style="color: red">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
<div class="flex flex-col">
  <div class="mt-2">
    {{ Form::label('name', 'Имя') }}
  </div>
  <div>
    {{Form::text('name', $task->name, ['class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('description', 'Описание') }}
  </div>
  <div>
    {{Form::textarea('description', $task->description, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => '50', 'rows' => '10'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('status_id', 'Статус') }}
  </div>
  <div>
    {{Form::select('status_id', $statuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
  </div>
  <div>
    {{Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('labels[]', 'Метки') }}
  </div>
  <div>
    {{Form::select('labels[]', $labelsDB, null, ['placeholder' => '',
                                                 'multiple' => true,
                                                 'class' => 'rounded border-gray-300 w-1/3 h-32'])}}
  </div>
 
