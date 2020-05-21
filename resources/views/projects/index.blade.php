@extends('layouts.app')

@section('content')
    <header class="flex items-center py-2">
        <div class="flex justify-between w-full items-center">
            <div class="text-default no-underline font-normal text-sm">My Projects</div>
            <a href="{{ route('projects.create') }}"
            class="button hover:bg-card hover:border-accent hover:text-accent border border-transparent mr-2 is-link"
            @click.prevent="$modal.show('new-project')"
            >New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 mb-3">
                <x-card :project="$project" height="h-48"/>
            </div>
        @empty
            <div class="card w-full">No projects yet!</div>
        @endforelse

        {{ $projects->links() }}
    </main>

    <new-project-modal></new-project-modal>
@endsection
