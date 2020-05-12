@extends('layouts.app')

@section('content')
<h1>Create Project</h1>
{!! Form::open(['url' => route('projects.store'), 'class' => '']) !!}
    {!! Form::label('title', 'Title', []) !!}
    {!! Form::text('title', '', []) !!}
    {!! Form::label('description', 'Description', []) !!}
    {!! Form::textarea('description', '', []) !!}
    {!! Form::submit('Submit', []) !!}
    <a href="{{ route('projects.index') }}">Cancel</a>
{!! Form::close() !!}
@endsection
