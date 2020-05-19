@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-4 py-4">
        <div class="flex justify-between w-full items-end">
            <div class="text-gray-400 no-underline font-normal text-sm">My Projects</div>
            <a href="{{ route('projects.create') }}" class="button">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 mb-3">
                <x-card :project="$project"/>
            </div>
        @empty
            <div>No projects yet!</div>
        @endforelse

        {{ $projects->links() }}
    </main>
@endsection
