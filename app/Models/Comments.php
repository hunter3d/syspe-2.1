<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Comments extends Model {
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'card_id',
        'message',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'card_id',
                'message',
            ])
            ->useLogName('Comments');
    }

    public function card(): BelongsTo {
        return $this->belongsTo( Cards::class );
    }
}
