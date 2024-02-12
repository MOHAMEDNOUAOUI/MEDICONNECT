<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicaments extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicament',
        'description',
        'price'
    ];
}
