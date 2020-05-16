@extends('layouts.app')

@section('content')
<div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">
        Let's start something new
    </h1>

    {!! Form::open(['url' => route('projects.store'), 'class' => '']) !!}
        <div class="field mb-6">
            {!! Form::label('title', 'Title', ['class' => 'label text-sm mb-2 block']) !!}
            <div class="control">
                {!! Form::text('title', '', ['class' => 'bg-transparent border border-muted-light rounded p-2 text-xs w-full']) !!}
            </div>
        </div>

        <div class="field mb-6">
            {!! Form::label('description', 'Description', ['class' => 'label text-sm mb-2 block']) !!}
            <div class="control">
                {!! Form::textarea('description', '', ['class' => 'bg-transparent border border-muted-light rounded p-2 text-xs w-full']) !!}
            </div>
        </div>

        <div class="field">
            <div class="control">
                {!! Form::submit('Submit', ['class' => 'button is-link mr-2']) !!}
                <a href="{{ route('projects.index') }}">Cancel</a>
            </div>
        </div>

    {!! Form::close() !!}
</div>
@endsection
