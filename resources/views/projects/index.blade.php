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
                <x-card :project="$project" height="h-48"/>
            </div>
        @empty
            <div>No projects yet!</div>
        @endforelse

        {{ $projects->links() }}
    </main>

    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let’s Start Something New</h1>
        <div class="flex">
            <div class="flex-1 mr-4">
                @include('projects._form')
            </div>
            <div class="flex-1 ml-4">

            </div>
        </div>
    </modal>

    <a href="" @click.prevent="$modal.show('new-project')">Show modal</a>
@endsection
