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
  <div>
    {{ Form::label('name', 'Имя') }}
  </div>
  <div class="mt-2">
    {{Form::text('name', $task->name, ['class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div>
    {{ Form::label('description', 'Описание') }}
  </div>
  <div class="mt-2">
    {{Form::textarea('description', $task->description, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => '50', 'rows' => '10'])}}
  </div>
  <div>
    {{ Form::label('status_id', 'Статус') }}
  </div>
  <div class="mt-2">
    {{Form::select('status_id', $statuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
  <div>
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
  </div>
  <div class="mt-2">
    {{Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3'])}}
  </div>
 
<div class="mt-2">
  <label for="labels">Метки</label>
</div>
<div>
  <select multiple="multiple" name="labels[]" class="rounded border-gray-300 w-1/3 h-32" id="labels">
  @if (old('labels') or $task->labels->isNotEmpty())
    <option value=""></option>
  @elseif ($labelsDB->isNotEmpty())
    <option selected="selected" value=""></option>
  @endif
  @foreach ($labelsDB as $labelDB)
                                                                 
    @if (((old('labels')) && (in_array($labelDB->id, old('labels')))) or (isset($task) && $task->labels->contains($labelDB)))
        <option value="{{ $labelDB->id }}" selected>{{ $labelDB->name }}</option>
    @else
        <option value="{{ $labelDB->id }}">{{ $labelDB->name }}</option>
    @endif
                                                                     
  @endforeach
  </select>
</div>