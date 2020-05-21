<div class="card flex flex-col {{ $height ?? '' }}">
    <div class="text-xl font-normal py-4 -ml-5 border-l-4 border-accent pl-4 mb-3">
        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
    </div>
    <p class="text-muted mb-4 flex-1">{{ Str::limit($project->description, 150) }}</p>

    <footer class="text-right">
        @can('delete', $project)
            <a href="{{ route('projects.destroy', $project) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="button-sm-red">{{ __('Delete') }}</a>
        @endcan
    </footer>
</div>
