@if ($errors->{$bag ?? 'default'}->any())
    @foreach ($errors->{$bag ?? 'default'}->all() as $error)
    <div class="bg-page border-l-4 border-red-300 text-red-500 p-4" role="alert">
        <p class="font-bold">Be Warned</p>
        <p>{{ $error }}</p>
    </div>
    @endforeach
@endif
