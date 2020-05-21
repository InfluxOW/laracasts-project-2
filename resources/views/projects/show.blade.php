@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-4 py-4 mb-3">
        <div class="flex justify-between items-center w-full">
            <p class="text-muted no-underline font-normal text-sm text-left">
                <a href="{{ route('projects.index') }}" class="text-default">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex">
                @foreach ($project->members as $user)
                    <img src="{{ $user->getAvatar() }}" alt="" class="rounded-full w-8 mr-2">
                @endforeach
                    <img src="{{ $project->owner->getAvatar() }}" alt="" class="rounded-full w-8">
                <a href="{{ route('projects.edit', $project) }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-6">
                    <div class="text-lg text-default no-underline font-normal mb-2">Tasks</div>

                    @foreach ($project->tasks as $task)
                        <div class="card">
                            {!! Form::open(['url' => route('projects.tasks.update', compact('task', 'project')), 'method' => 'PATCH']) !!}
                                <div class="flex">
                                    <div class="w-full">
                                        {!! Form::text('body', $task->body,
                                        ['placeholder' => 'Update a task...', 'class' => $task->completed ? 'text-muted line-through bg-card' : 'bg-card']) !!}
                                    </div>
                                    {!! Form::checkbox('completed', true, $task->completed ?? false, ['onChange' => "this.form.submit()"]) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    @endforeach

                    <div class="card">
                        {!! Form::open(['url' => route('projects.tasks.store', $project)]) !!}
                            {!! Form::text('body', '', ['placeholder' => 'Add a new task...', 'class' => 'w-full bg-card']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div>
                    <div class="text-lg text-default no-underline font-normal mb-2">General Notes</div>
                    <div class="w-full border border-muted-light rounded-lg p-4 bg-card">
                        {!! Form::open(['url' => route('projects.update', $project), 'method' => 'PATCH']) !!}
                            {!! Form::textarea('notes', $project->notes, ['placeholder' => 'Add any notes here...', 'class' => 'w-full bg-card']) !!}
                            {!! Form::submit('Save', ['class' => 'button']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                <x-card :project="$project"/>
                <x-activity :project="$project"/>
                @can('invite', $project)
                    <x-invitation-form :project="$project"/>
                @endcan
            </div>
        </div>
    </main>
@endsection
