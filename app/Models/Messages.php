<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Messages extends Model
{
    use HasFactory, Sortable, LogsActivity;

    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id',
                'user_id',
                'name',
                'description'
            ])
            ->useLogName('Messages');
    }

    public $sortable = [
        'id',
        'user_id',
        'name',
        'description'
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }
}
