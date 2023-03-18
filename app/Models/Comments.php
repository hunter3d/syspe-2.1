<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
            ->useLogName('Cardcomment');
    }
}
