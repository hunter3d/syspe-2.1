<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tickets extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'visitor_id',
        'exhibition_id',
        'event_id',
        'order_id',
        'code',
        'file',
        'deactivated',
        'checked_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'visitor_id',
                'exhibition_id',
                'event_id',
                'order_id',
                'code',
                'file',
                'deactivated',
                'checked_at',
            ])
            ->useLogName('Tickets');
    }

    public $sortable = [
        'id',
        'visitor_id',
        'exhibition_id',
        'event_id',
        'order_id',
        'code',
        'file',
        'deactivated',
        'checked_at',
    ];

    public function visitor() {
        return $this->belongsTo( Visitor::class );
    }
    public function exhibition() {
        return $this->belongsTo( Exhibition::class );
    }
    public function event() {
        return $this->belongsTo(Event::class);
    }
    public function order() {
        return $this->belongsTo(Orders::class);
    }
}
