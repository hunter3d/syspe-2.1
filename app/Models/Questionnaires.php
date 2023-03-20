<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Kyslik\ColumnSortable\Sortable;

class Questionnaires extends Model
{
    use HasFactory, LogsActivity, Sortable;

    protected $fillable = [
        'exhibition_id',
        'type',
        'question_uk',
        'question_ru',
        'question_en',
        'template',
    ];

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'exhibition_id',
                'type',
                'question_uk',
                'question_ru',
                'question_en',
                'template',
            ])
            ->useLogName('Questionnaires');
    }

    public $sortable = [
        'id',
        'exhibition_id',
        'type',
        'question_uk',
        'question_ru',
        'question_en',
        'template',
    ];

    public function exhibition(): BelongsTo {
        return $this->belongsTo( Exhibition::class );
    }

    public function answeroptions(): HasMany {
        return $this->hasMany( Answeroptions::class );
    }

}
