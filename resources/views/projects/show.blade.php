@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-4 py-4 mb-3">
        <div class="flex justify-between w-full items-end">
            <div class="text-gray-400 no-underline font-normal text-sm">
                <a href="{{ route('projects.index') }}">My Projects</a> / {{ $project->title }}
            </div>
            <a href="{{ route('projects.edit', $project) }}" class="button">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-6">
                    <div class="text-lg text-gray-400 no-underline font-normal mb-2">Tasks</div>

                    @foreach ($project->tasks as $task)
                        <div class="card">
                            {!! Form::open(['url' => route('projects.tasks.update', compact('task', 'project')), 'method' => 'PATCH']) !!}
                                <div class="flex">
                                    <div class="w-full">
                                        {!! Form::text('body', $task->body,
                                        ['placeholder' => 'Update a task...', 'class' => $task->completed ? 'text-gray-400' : '']) !!}
                                    </div>
                                    {!! Form::checkbox('completed', true, $task->completed ?? false, ['onChange' => "this.form.submit()"]) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    @endforeach

                    <div class="card">
                        {!! Form::open(['url' => route('projects.tasks.store', $project)]) !!}
                            {!! Form::text('body', '', ['placeholder' => 'Add a new task...', 'class' => 'w-full']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div>
                    <div class="text-lg text-gray-400 no-underline font-normal mb-2">General Notes</div>
                    <div class="w-full border border-blue-200 rounded-lg p-4">
                        {!! Form::open(['url' => route('projects.update', $project), 'method' => 'PATCH']) !!}
                            {!! Form::textarea('notes', $project->notes, ['placeholder' => 'Add any notes here...', 'class' => 'w-full']) !!}
                            {!! Form::submit('Save', ['class' => 'button']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                <x-card :project="$project"/>
                <x-activity :project="$project"/>
            </div>
        </div>
    </main>
@endsection
