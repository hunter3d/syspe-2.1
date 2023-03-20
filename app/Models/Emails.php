<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Emails extends Model {
    use HasFactory, LogsActivity;

    protected $fillable = [
        'card_id',
        'email',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'card_id',
                'email',
            ])
            ->useLogName('Emails');
    }

    public function card(): BelongsTo {
        return $this->belongsTo( Cards::class );
    }
}
