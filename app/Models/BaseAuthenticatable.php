<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BaseAuthenticatable extends Authenticatable
{
    use LogsActivity;
    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " on user";
    }

    /**
     * Configure what attributes and options to log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()              // Log all attributes
            ->logOnlyDirty()        // Only log changed attributes
            ->dontSubmitEmptyLogs() // Do not log if nothing changed
            ->useLogName('user');   // Custom log name 'user'
    }
}
