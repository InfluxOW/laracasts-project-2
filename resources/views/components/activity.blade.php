<div class="card">
    <ul class="text-xs">
        <table class="table-fixed">
        @foreach ($project->activities as $activity)
            <tbody class="text-center">
                <tr>
                    <td class="w-2/3 px-4 py-2">
                        @if ($activity->changes)
                            <modal name="activity-{{ $activity->id }}" classes="p-10 bg-card rounded-lg border border-muted" height="200px">
                                    <pre>{{ json_encode($activity->changes, JSON_PRETTY_PRINT)}}</pre>
                            </modal>
                            <a href="" @click.prevent='$modal.show("activity-{{ $activity->id }}")'>
                                @include("projects.activities.{$activity->description}")
                            </a>
                        @else
                            @include("projects.activities.{$activity->description}")
                        @endif
                    </td>
                    <td class="w-1/3 px-4 py-2"><span class="text-muted">{{ $activity->created_at->diffForHumans(null, true) }}</span></td>
                </tr>
            </tbody>


        @endforeach
        </table>
    </ul>
</div>
