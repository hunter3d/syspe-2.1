<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Exhibition extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'name',
        'description',
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
        'logo_path',
        'logo_name',
        'template',
    ];

//    protected $touches = ['cards'];
//
//    public function cards()
//    {
//        return $this
//            ->belongsToMany(Card::class)
//            ->using(CardExhibition::class);
//    }
//
    public function events(): HasMany {
        return $this->hasMany(Events::class);
    }

    public function cards(): HasMany {
        return $this->hasMany( Cards::class );
    }
//    public function order() {
//        return $this->hasMany(Orders::class);
//    }
//    public function tickets() {
//        return $this->hasMany( Tickets::class );
//    }
//    public function questionnaires() {
//        return $this->hasMany( Questionnaires::class);
//    }
//    public function cardtopic() {
//        return $this->hasMany( Cardtopic::class);
//    }
//    public function answers() {
//        return $this->hasMany( Answers::class);
//    }
}

//// rebuild Scout index
//class CardExhibition extends Pivot
//{
//    public static function boot()
//    {
//        parent::boot();
//        static::deleted(function ( $item )
//        {
//            Card::find($item->card_id)->touch();
//        });
//    }
//}
