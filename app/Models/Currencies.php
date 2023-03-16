<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ru',
        'name_uk',
        'name_en',
    ];
}
