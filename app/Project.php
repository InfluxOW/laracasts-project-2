<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }
}
