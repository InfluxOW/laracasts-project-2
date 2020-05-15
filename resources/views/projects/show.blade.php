@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-4 py-4 mb-3">
        <div class="flex justify-between w-full items-end">
            <div class="text-gray-400 no-underline font-normal text-sm">
                <a href="{{ route('projects.index') }}">My Projects</a> / {{ $project->title }}
            </div>
            <a href="{{ route('projects.create') }}" class="button">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-4">
                    <div class="text-lg text-gray-400 no-underline font-normal mb-2">Tasks</div>
                    @forelse ($project->tasks as $task)
                        <div class="card">{{ $task->body }}</div>
                    @empty
                        <div class="card">No tasks!</div>
                    @endforelse
                </div>

                <div>
                    <div class="text-lg text-gray-400 no-underline font-normal mb-2">General Notes</div>
                    <textarea class="card w-full">Something</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                <x-card :project="$project"/>
            </div>
        </div>
    </main>
@endsection
