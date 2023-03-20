<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function visitor(): BelongsTo {
        return $this->belongsTo( Visitor::class );
    }

    public function topic(): BelongsTo {
        return $this->belongsTo( Topics::class );
    }

    public function country(): BelongsTo {
        return $this->belongsTo( Countries::class );
    }

    public function exhibitions(): BelongsToMany {
        return $this->belongsToMany( Exhibition::class );
    }

    public function emails(): HasMany {
        return $this->hasMany( Emails::class );
    }

    public function phones(): HasMany {
        return $this->hasMany( Phones::class );
    }

    public function comments(): HasMany {
        return $this->hasMany( Comments::class );
    }
}
