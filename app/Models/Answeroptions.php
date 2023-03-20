<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Answeroptions extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'questionnaire_id',
        'answer_uk',
        'answer_ru',
        'answer_en',
        'order',
    ];

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'questionnaire_id',
                'answer_uk',
                'answer_ru',
                'answer_en',
                'order',
            ])
            ->useLogName('Questionnaires');
    }

}
