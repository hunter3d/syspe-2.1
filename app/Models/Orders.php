<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Orders extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'visitor_id',
        'exhibition_id',
        'event_id',
        'promocode_id',
        'number',
        'pay_method',
        'price',
        'currency',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'visitor_id',
                'exhibition_id',
                'event_id',
                'promocode_id',
                'number',
                'pay_method',
                'price',
                'currency_id',
                'status',
            ])
            ->useLogName('Orders');
    }

    public $sortable = [
        'id',
        'visitor_id',
        'exhibition_id',
        'event_id',
        'promocode_id',
        'number',
        'pay_method',
        'price',
        'currency',
        'status',
        'created_at',
    ];

    public function currency(): BelongsTo {
        return $this->belongsTo( Currencies::class );
    }
    public function visitor(): BelongsTo {
        return $this->belongsTo(Visitor::class);
    }
    public function exhibition(): BelongsTo {
        return $this->belongsTo(Exhibition::class);
    }
    public function event(): BelongsTo {
        return $this->belongsTo(Events::class);
    }
    public function promocode(): BelongsTo {
        return $this->belongsTo(Promocodes::class);
    }

    public function ticket(): HasOne {
        return $this->hasOne(Tickets::class);
    }
}
