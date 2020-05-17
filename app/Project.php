<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'notes'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function addTask($data)
    {
        $task = Task::make($data);
        return $this->tasks()->save($task);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function recordActivity($description)
    {
        $activity = Activity::make(['description' => $description]);
        $this->activity()->save($activity);
    }
}
