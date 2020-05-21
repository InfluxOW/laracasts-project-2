<div class="field mb-6">
    {!! Form::label('title', 'Title', ['class' => 'label text-sm mb-2 block']) !!}
    <div class="control">
        {!! Form::text('title', $project->title ?? '',
        ['class' => 'bg-page border border-muted-light rounded p-2 text-xs w-full', 'required']) !!}
    </div>
</div>

<div class="field mb-6">
    {!! Form::label('description', 'Description', ['class' => 'label text-sm mb-2 block']) !!}
    <div class="control">
        {!! Form::textarea('description', $project->description ?? '',
        ['class' => 'bg-page border border-muted-light rounded p-2 text-xs w-full', 'required']) !!}
    </div>
</div>
