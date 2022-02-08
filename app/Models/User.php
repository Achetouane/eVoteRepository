<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Candidat;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role',
    //     'userable_id',
    //     'userable_type'
        
        
    // ];

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
    ];

    public function votes()
    {
        return $this->belongsToMany(Vote::class, 'user_vote')->withPivot('candidat_id');
    }

    public function nomPrenomCiv()
    {
        return 'Mlle' . ' ' . $this->name . ' ' . $this->email;
    }

  

   
}
