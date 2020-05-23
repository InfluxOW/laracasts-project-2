<?php

namespace App;

use App\Traits\TriggersActivity;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use TriggersActivity;

    protected $fillable = ['title', 'description', 'notes'];
    protected static $activityEvents = ['created', 'updated'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function addTask($task)
    {
        return $this->tasks()->create($task);
    }

    public function addTasks($tasks)
    {
        return $this->tasks()->createMany($tasks);
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }
}
