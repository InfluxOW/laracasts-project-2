<?php

namespace App;

use App\Traits\TriggersActivity;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use TriggersActivity;

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
}
