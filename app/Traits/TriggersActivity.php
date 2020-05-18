<?php

namespace App\Traits;

use App\Activity;
use Illuminate\Support\Arr;

trait TriggersActivity
{
    public $oldAttributes = [];

    public function activities()
    {
        if (class_basename($this) === 'Project') {
            return $this->hasMany(Activity::class)->latest();
        }

        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function recordActivity($description)
    {
        $activity = Activity::make([
            'description' => $description,
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
            'changes' => $this->activityChanges()
        ]);
        $this->activities()->save($activity);
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(
                    array_diff($this->oldAttributes, $this->getAttributes()),
                    'updated_at'
                ),
                'after' => Arr::except(
                    $this->getChanges(),
                    'updated_at'
                )
            ];
        }
    }
}
