<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTaskValidation;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTaskValidation $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = $request->only(['body']);
        $task = $project->addTask($data);

        return redirect()->route('projects.show', $project);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectTaskValidation $request, Project $project, Task $task)
    {
        $this->authorize($task->project);

        $task->update(['body' => $request->body]);

        if ($request->completed) {
            if (!$task->completed) {
                $task->complete();
            }
        } elseif ($task->completed) {
            $task->incomplete();
        }

        return redirect()->route('projects.show', $project);
    }
}
