<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        return $user->is($project->owner);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $user->is($project->owner);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        return false;
    }
}
