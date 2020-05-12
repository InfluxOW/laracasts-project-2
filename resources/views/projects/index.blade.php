@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-4">
        <a href="{{ route('projects.create') }}">New Project</a>
    </div>

    <div class="flex">
        @forelse ($projects as $project)
            <div class="bg-white mr-4 p-5 rounded shadow-custom w-1/3 h-48">
                <div class="text-xl font-normal py-4">{{ $project->title }}</div>
                <div class="text-gray-dark">{{ Str::limit($project->description, 200) }}</div>
            </div>
        @empty
            <div>No projects yet!</div>
        @endforelse
    </div>
@endsection
