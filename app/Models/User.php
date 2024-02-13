<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\appointement;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phonenumber',
        'id_specialite'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'id_specialite');
    }



    public function appointmentsAsPatient()
    {
        return $this->hasMany(appointement::class, 'patient_id');
    }

    public function appointmentsAsDoctor()
    {
        return $this->hasMany(appointement::class, 'doctor_id');
    }


    public function favoriteDoctors()
    {
        return $this->hasMany(favourite::class, 'patient_id');
    }



    public function patientComments() {
        return $this->hasMany(comments::class, 'patient_id');
    }

    public function doctorComments()
    {
        return $this->hasMany(comments::class, 'doctor_id');
    }


    public function rating()
{
    return $this->hasOne(ratings::class, 'patient_id');
}

public function receivedRatings()
{
    return $this->hasMany(ratings::class, 'doctor_id');
}
    

}
