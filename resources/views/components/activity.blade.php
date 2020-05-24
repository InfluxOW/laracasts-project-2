<div class="card">
    <table class="fixed-header text-xs">
        <tbody class="text-center">
            @foreach ($project->activities as $activity)
            <tr>
                <td class="w-2/3 px-2 py-2">
                    @if ($activity->changes && !array_key_exists('completed', $activity->changes['after']))
                        <modal name="activity-{{ $activity->id }}" classes="p-10 bg-card rounded-lg border border-muted" height="200px">
                                <pre>{{ json_encode($activity->changes, JSON_PRETTY_PRINT)}}</pre>
                        </modal>
                        <a href="" @click.prevent='$modal.show("activity-{{ $activity->id }}")' class="font-bold">
                            @include("projects.activities.{$activity->description}")
                        </a>
                    @else
                        @include("projects.activities.{$activity->description}")
                    @endif
                </td>
                <td class="w-1/3 px-2 py-2"><span class="text-muted">{{ $activity->created_at->format('d M h:i') }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
