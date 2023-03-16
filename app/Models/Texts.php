<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Texts extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'text_ru',
        'text_uk',
        'text_en',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'name_ru',
                'name_uk',
                'name_en',
            ])
            ->useLogName('Texts');
    }
}
