<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationValidation;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectInvitationValidation $request, Project $project)
    {
        $this->authorize('invite', $project);

        $user = User::whereEmail($request->email)->first();
        $project->invite($user);

        return redirect()->route('projects.show', $project);
    }
}
