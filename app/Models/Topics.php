<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Topics extends Model {
    use HasFactory, LogsActivity, Sortable;

    protected $fillable = [
        'exhibition_id',
        'name_uk',
        'name_ru',
        'name_en',
        'template',
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
                'template',
            ])
            ->useLogName('Topics');
    }
    public $sortable = [
        'id',
        'exhibition_id',
        'name_uk',
        'name_ru',
        'name_en',
        'template',
    ];
}
