<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Promocodes extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'event_id',
        'code',
        'description',
        'price_uah',
        'price_euro',
        'price_usd',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'event_id',
                'code',
                'description',
                'price_uah',
                'price_euro',
                'price_usd',
            ])
            ->useLogName('Promocode');
    }

    public $sortable = [
        'id',
        'event_id',
        'code',
        'description',
        'price_uah',
        'price_euro',
        'price_usd',
    ];

    public function event(): BelongsTo {
        return $this->belongsTo( Events::class );
    }
    public function orders(): HasMany {
        return $this->hasMany(Orders::class);
    }
}
