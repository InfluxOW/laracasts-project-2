<?php

namespace App;

use App\Traits\TriggersActivity;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use TriggersActivity;

    protected $fillable = ['body', 'completed'];
    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->recordActivity('task_completed');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('task_incompleted');
    }
}
