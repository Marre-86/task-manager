@if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li style="color: red">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

<div>
  <label for="name">Имя</label>
</div>
<div class="mt-2">
  <input class="rounded border-gray-300 w-1/3" name="name" type="text" value="{{ old('name') ?? $task->name }}" id="name">
</div>
<div class="mt-2">
  <label for="description">Описание</label>
</div>  
<div>
  <textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description" id="description">{{ old('description') ?? $task->description }}</textarea>
</div>
<div class="mt-2">
  <label for="status_id">Статус</label>
</div>
<div>
  <select class="rounded border-gray-300 w-1/3" id="status_id" name="status_id">
    @if (old('status_id') or isset($task))
      <option value="">----------</option>
    @else
      <option selected="selected" value="">----------</option>      
    @endif
    @foreach ($statuses as $status)    
      @if (((old('status_id')) && ($status->id == old('status_id')[0])) or (isset($task) && ($status->id == $task->status_id)))
        <option selected="selected" value="{{ $status->id }}">{{ $status->name }}</option>
      @else
        <option value="{{ $status->id }}">{{ $status->name }}</option>
      @endif
    @endforeach
  </select>
</div>  

<div class="mt-2">
  <label for="assigned_to_id">Исполнитель</label>
</div>

<div>
  <select class="rounded border-gray-300 w-1/3" id="assigned_to_id" name="assigned_to_id">    
    @if (old('assigned_to_id') or isset($task))
      <option value="">----------</option>
    @else
      <option selected="selected" value="">----------</option>      
    @endif
    @foreach ($users as $user)    
      @if (((old('assigned_to_id')) && ($user->id == old('assigned_to_id')[0])) or (isset($task) && ($user->id == $task->assigned_to_id)))
        <option selected="selected" value="{{ $user->id }}">{{ $user->name }}</option>
      @else
        <option value="{{ $user->id }}">{{ $user->name }}</option>
      @endif
    @endforeach
  </select>
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