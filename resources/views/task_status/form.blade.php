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
    {{Form::text('name', $taskStatus->name, ['class' => 'rounded border-gray-300 w-1/3'])}}
  </div>