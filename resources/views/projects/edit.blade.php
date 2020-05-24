@extends('layouts.app')

@section('content')
<div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">
        Edit your project
    </h1>

    {!! Form::open(['url' => route('projects.update', $project), 'method' => 'PATCH']) !!}

        @include('projects._form')

        <div class="field">
            <div class="control flex items-center">
                {!! Form::button('Update', ['class' => 'button w-full mr-2 is-link', 'type' => 'submit']) !!}
                <a href="{{ route('projects.index') }}" class="button-sm-no-bg">Cancel</a>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
