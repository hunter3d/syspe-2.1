<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model {
    use HasFactory;

    protected $fillable = [
        'name_uk',
        'name_ru',
        'name_en',
    ];
}
