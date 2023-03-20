<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currencies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ru',
        'name_uk',
        'name_en',
    ];

    public function orders(): HasMany {
        return $this->hasMany( Orders::class );
    }
}
