<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class VisitorsReset extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'email',
        'token',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'email',
                'token',
            ])
            ->useLogName('VisitorReset');
    }

    public $sortable = [
        'id',
        'email',
        'token',
    ];
}
