<div class="card h-48">
    <div class="text-xl font-normal py-4 -ml-5 border-l-4 border-blue-custom pl-4 mb-3">
        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
    </div>
    <div class="text-gray-dark">{{ Str::limit($project->description, 200) }}</div>
</div>
