@extends('layouts.app')

@section('content')
<div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">
        Let's start something new
    </h1>

    {!! Form::open(['url' => route('projects.store'), 'class' => '']) !!}

        @include('projects._form')

        <div class="field">
            <div class="control">
                {!! Form::button('Create', ['class' => 'button is-link mr-2', 'type' => 'submit']) !!}
                <a href="{{ route('projects.index') }}">Cancel</a>
            </div>
        </div>

    {!! Form::close() !!}
</div>
@endsection
