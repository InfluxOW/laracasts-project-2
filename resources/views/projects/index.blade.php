@extends('layouts.app')

@section('content')
    <header class="flex items-center py-2">
        <div class="flex justify-between w-full items-center">
            <div class="text-default no-underline font-normal text-sm">My Projects</div>
            <a href="{{ route('projects.create') }}" class="button hover:bg-card hover:border-accent hover:text-accent border border-transparent mr-2 is-link">New Project</a>
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

    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        {{-- <div class="p-10 bg-card rounded-lg"> --}}
            <h1 class="font-normal mb-16 text-center text-2xl text-default">Let’s Start Something New</h1>
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="field mb-6">
                        {!! Form::label('title', 'Title', ['class' => 'label text-sm mb-2 block']) !!}
                        <div class="control">
                            {!! Form::text('title', '',
                            ['class' => 'bg-page border border-muted-light rounded p-2 text-xs w-full', 'required']) !!}
                        </div>
                    </div>

                    <div class="field mb-6">
                        {!! Form::label('description', 'Description', ['class' => 'label text-sm mb-2 block']) !!}
                        <div class="control">
                            {!! Form::textarea('description', '',
                            ['class' => 'bg-page border border-muted-light rounded p-2 text-xs w-full', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="field mb-2">
                        {!! Form::label('body', 'Need some tasks?', ['class' => 'label text-sm mb-2 block']) !!}
                        <div class="control">
                            {!! Form::text('body', '',
                            ['class' => 'bg-page border border-muted-light rounded p-2 text-xs w-full', 'placeholder' => 'Task 1']) !!}
                        </div>
                    </div>
                        <button type="submit" class="inline-flex items-center text-xs">
                            <img src="{{ asset('/icons/add.svg') }}" alt="" width="32px" class="mr-2 rounded-full border border-transparent hover:border-muted-light">
                            <span class="text-muted">Add New Task Field</span>
                        </button>
                </div>
            </div>
        {{-- </div> --}}
        <footer>
            <div class="field">
                <div class="control flex items-center justify-end">
                    {!! Form::button('Create', ['class' => 'button hover:bg-card hover:border-accent hover:text-accent border border-transparent mr-2 is-link', 'type' => 'submit']) !!}
                    <a href="{{ route('projects.index') }}" class="text-sm text-accent no-underline whitespace-no-wrap border border-transparent hover:border-accent py-2 px-4 rounded-lg">Cancel</a>
                </div>
            </div>
        </footer>
    </modal>

    <a href="" @click.prevent="$modal.show('new-project')">Show modal</a>
@endsection
