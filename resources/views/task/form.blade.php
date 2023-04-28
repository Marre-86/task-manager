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
    {{ Form::label('name', __('task.title_task_name')) }}
  </div>
  <div>
    {{Form::text('name', $task->name, ['class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('description', __('task.title_description')) }}
  </div>
  <div>
    {{Form::textarea('description', $task->description, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => '50', 'rows' => '10'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('status_id', __('task.title_status')) }}
  </div>
  <div>
    {{Form::select('status_id', $statuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('assigned_to_id', __('task.title_assigned_to')) }}
  </div>
  <div>
    {{Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div class="mt-2">
    {{ Form::label('labels[]', __('task.title_labels')) }}
  </div>
  <div>
    {{Form::select('labels[]', $labelsDB, null, ['placeholder' => '',
                                                 'multiple' => true,
                                                 'class' => 'rounded border-gray-300 w-1/3 h-32'])}}
  </div>
 
