<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
                'currency',
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

//    public function visitor() {
//        return $this->belongsTo(Visitor::class);
//    }
//    public function exhibition() {
//        return $this->belongsTo(Exhibition::class);
//    }
//    public function event() {
//        return $this->belongsTo(Event::class);
//    }
//    public function promocode() {
//        return $this->belongsTo(Promocodes::class);
//    }
//
//    public function ticket() {
//        return $this->hasMany(Tickets::class, 'order_id');
//    }
}
