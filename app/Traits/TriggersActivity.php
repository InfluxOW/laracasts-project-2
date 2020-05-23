<?php

namespace App\Traits;

use App\Activity;
use Auth;
use Illuminate\Support\Arr;

trait TriggersActivity
{
    public $oldAttributes = [];

    public static function bootTriggersActivity()
    {
        $activityEvents = static::$activityEvents ?? ['created', 'updated', 'deleted'];

        foreach ($activityEvents as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

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
            'user_id' => Auth::user()->id ?? ($this->project ?? $this)->owner_id,
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

    protected function activityDescription($description)
    {
        return strtolower(class_basename($this)) . "_{$description}";
    }
}
