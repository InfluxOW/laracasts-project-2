@if ($errors->{$bag ?? 'default'}->has($name))
    @foreach ($errors->{$bag ?? 'default'}->get($name) as $error)
        <div class="text-red-500 text-xs italic mt-4">
            {{ $error }}
        </div>
    @endforeach
@endif
