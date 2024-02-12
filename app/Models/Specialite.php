<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;


    protected $fillable = [
        'Specialite'
    ];


    public function users()
    {
        return $this->hasMany(User::class, 'id_specialite');
    }
}
