<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Countries extends Model {
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'code',
        'name_uk',
        'name_ru',
        'name_en',
    ];

    public function cards(): HasMany {
        return $this->hasMany( Cards::class );
    }
}
