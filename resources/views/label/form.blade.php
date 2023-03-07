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
                        <input class="rounded border-gray-300 w-1/3" name="name" type="text"
                        value="{{ $label->name }}" id="name">
                    </div>
                    <div class="mt-2">
                        <label for="description">Описание</label>
                    </div>
                    <div class="mt-2">
                        <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" cols="50" rows="10"
                          id="description">{{ old('description') ?? $label->description }}</textarea>
                    </div>
