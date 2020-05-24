@if (array_key_exists('completed', $activity->changes['after']))
    @if ($activity->changes['after']['completed'])
        @include('projects.activities.task_completed')
    @else
        @include('projects.activities.task_incompleted')
    @endif
@elseif (array_key_exists('body', $activity->changes['after']))
    {{ $activity->user->name }} updated task "{{ $activity->subject->body }}"
@endif
