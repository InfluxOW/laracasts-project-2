<div class="card mt-3">
    <ul class="text-xs">
        @foreach ($project->activities as $activity)
            <li class="{{ $loop->last ? '' : 'mb-3'}} flex justify-between">
                @include("projects.activities.{$activity->description}")
                <span class="text-gray-500">{{ $activity->created_at->diffForHumans(null, true) }}</span>
            </li>
        @endforeach
    </ul>
</div>
