<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cards extends Model
{
    use HasFactory, Sortable, LogsActivity, Searchable;

    protected $fillable = [
        'visitor_id',
        'country_id',
        'first_name',
        'second_name',
        'last_name',
        'company',
        'topic_id',
        'position',
        'post_code',
        'region',
        'district',
        'city',
        'street',
        'house',
        'office',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'visitor_id',
                'country_id',
                'first_name',
                'second_name',
                'last_name',
                'company',
                'topic_id',
                'position',
                'post_code',
                'region',
                'district',
                'city',
                'street',
                'house',
                'office',
                'status',
            ])
            ->useLogName('Cards');
    }

    public $sortable = [
        'id',
        'visitor_id',
        'country_id',
        'first_name',
        'second_name',
        'last_name',
        'company',
        'topic_id',
        'position',
        'post_code',
        'region',
        'district',
        'city',
        'street',
        'house',
        'office',
        'status',
    ];
}
