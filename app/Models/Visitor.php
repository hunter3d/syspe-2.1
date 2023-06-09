<?php
# (c) PremierExpo 2022

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Visitor extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Sortable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        //'name',
        'email',
        'password',
        'is_blocked',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'email',
                'password',
                'is_blocked',
            ])
            ->useLogName('Visitor');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    public $sortable = [
        'id',
        'email',
        'email_verified_at',
        'is_blocked',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function card(): HasOne {
        return $this->hasOne( Cards::class );
    }

    public function order(): HasMany {
        return $this->hasMany( Orders::class );
    }
    public function tickets(): HasMany {
        return $this->hasMany( Tickets::class );
    }

    public function emailcode(): HasOne {
        return $this->hasOne( Emailcodes::class );
    }

    public function answers(): HasMany {
        return $this->hasMany( Answers::class );
    }
}
