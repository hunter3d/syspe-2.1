<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Exhibitions extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'url',
        'logo_path',
        'logo_name',
        'template',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'name',
                'description',
                'url',
                'logo_path',
                'logo_name',
                'template',
            ])
            ->useLogName('Exhibitions');
    }

    public $sortable = [
        'id',
        'name',
        'description',
        'url',
        'logo_path',
        'logo_name',
        'template',
    ];

    protected $touches = ['cards'];

    public function cards()
    {
        return $this
            ->hasMany(Cards::class)
            ->using(CardExhibition::class);
    }

    public function events(): HasMany {
        return $this->hasMany(Events::class);
    }

//    public function cards(): HasMany {
//        return $this->hasMany( Cards::class );
//    }
    public function orders(): HasMany {
        return $this->hasMany(Orders::class);
    }
    public function tickets(): HasMany {
        return $this->hasMany( Tickets::class );
    }
    public function questionnaires() {
        return $this->hasMany( Questionnaires::class );
    }
    public function topics() {
        return $this->hasMany( Topics::class);
    }
    public function answers() {
        return $this->hasMany( Answers::class);
    }
}

// rebuild Scout index
class CardExhibition extends Pivot {
    public static function boot()
    {
        parent::boot();
        static::deleted(function ( $item )
        {
            Cards::find($item->card_id)->touch();
        });
    }
}
