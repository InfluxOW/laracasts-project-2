@extends('layouts.app')

@section('content')
    <h1>Birdboard</h1>

    <h2>{{ $project->title }}</h2>
    <h3>{{ $project->description }}</h3>

    <a href="{{ route('projects.index') }}">Go Back</a>
@endsection
