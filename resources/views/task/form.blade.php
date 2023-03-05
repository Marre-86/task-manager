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
  <input class="rounded border-gray-300 w-1/3" name="name" type="text" value="{{ old('name') }}" id="name">
</div>
<div class="mt-2">
  <label for="description">Описание</label>
</div>  
<div>
  <textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description" id="description">{{ old('description') }}</textarea>
</div>
<div class="mt-2">
  <label for="status_id">Статус</label>
</div>
<div>
  <select class="rounded border-gray-300 w-1/3" id="status_id" name="status_id">
    @if (old('status_id'))
      <option value="">----------</option>
    @else
      <option selected="selected" value="">----------</option>      
    @endif
    @foreach ($statuses as $status)    
      @if ((old('status_id')) && ($loop->iteration == old('status_id')[0]))
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
    @if (old('assigned_to_id'))
      <option value="">----------</option>
    @else
      <option selected="selected" value="">----------</option>      
    @endif
    @foreach ($users as $user)    
      @if ((old('assigned_to_id')) && ($user->id == old('assigned_to_id')[0]))
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
  @if (old('labels'))
    <option value=""></option>
  @else
    <option selected="selected" value=""></option>
  @endif
  @for ($i = 1; $i <= count($label_options) - 1; $i++)
    @if ((old('labels')) && ($i == old('labels')[0]))
        <option value="{{ $i }}" selected>{{ $label_options[$i] }}</option>
    @else
        <option value="{{ $i }}">{{ $label_options[$i] }}</option>
    @endif
  @endfor
  </select>
</div>