<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['body', 'completed'];
    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
