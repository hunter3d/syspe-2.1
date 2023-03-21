<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Events extends Model {
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'exhibition_id',
        'name_uk',
        'name_ru',
        'name_en',
        'description_uk',
        'description_ru',
        'description_en',
        'location_uk',
        'location_ru',
        'location_en',
        'logo_path',
        'logo_name',
        'ticket_temp_path',
        'ticket_temp_name',
        'start',
        'stop',
        'can_promo',
        'can_card',
        'can_invoice',
        'pay_uah',
        'pay_euro',
        'pay_usd',
        'price_uah',
        'price_euro',
        'price_usd',
        'template'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'exhibition_id',
                'name_uk',
                'name_ru',
                'name_en',
                'description_uk',
                'description_ru',
                'description_en',
                'location_uk',
                'location_ru',
                'location_en',
                'logo_path',
                'logo_name',
                'ticket_temp_path',
                'ticket_temp_name',
                'start',
                'stop',
                'can_promo',
                'can_card',
                'can_invoice',
                'pay_uah',
                'pay_euro',
                'pay_usd',
                'price_uah',
                'price_euro',
                'price_usd',
                'template'
            ])
            ->useLogName('Events');
    }

    public $sortable = [
        'id',
        'exhibition_id',
        'name_uk',
        'name_ru',
        'name_en',
        'description_uk',
        'description_ru',
        'description_en',
        'location_uk',
        'location_ru',
        'location_en',
        'logo_path',
        'logo_name',
        'ticket_temp_path',
        'ticket_temp_name',
        'start',
        'stop',
        'can_promo',
        'can_card',
        'can_invoice',
        'pay_uah',
        'pay_euro',
        'pay_usd',
        'price_uah',
        'price_euro',
        'price_usd',
        'template'
    ];

    public function exhibition(): BelongsTo {
        return $this->belongsTo( Exhibition::class );
    }

    public function orders(): HasMany {
        return $this->hasMany( Orders::class, 'event_id', 'id' );
    }

    public function promocodes(): HasMany {
        return $this->hasMany( Promocodes::class, 'event_id', 'id' );
    }

    public function tickets(): HasMany {
        return $this->hasMany( Tickets::class, 'event_id', 'id' );
    }
}
