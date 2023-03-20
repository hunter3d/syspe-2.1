<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Emailcodes extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'visitor_id',
        'validation_code',
        'password',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'visitor_id',
                'validation_code',
                'password',
            ])
            ->useLogName('Emailcodes');
    }

    public function visitor(): BelongsTo {
        return $this->belongsTo( Visitor::class );
    }

}
