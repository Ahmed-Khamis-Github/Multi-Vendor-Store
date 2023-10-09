<div>

    @props(['name', 'value', 'label'])



    <label for="{{ $label }}">{{ $label }}</label>

    <textarea 
    name="{{ $name }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
{{ old($name, $value) }}
    </textarea>




    @error("$name")
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror



</div>
