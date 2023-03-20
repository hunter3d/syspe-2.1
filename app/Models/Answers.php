<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Answers extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'visitor_id',
        'exhibition_id',
        'event_id',
        'data',
    ];

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'visitor_id',
                'exhibition_id',
                'event_id',
                'data',
            ])
            ->useLogName('Questionnaires');
    }
}
