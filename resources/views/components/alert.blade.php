<div>

    @if (session()->has("$type"))
        <div class="alert alert-{{ $type }} mt-2"> {{ session($type) }} </div>
    @endif

</div>
