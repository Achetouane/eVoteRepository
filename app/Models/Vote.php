<?php

namespace App\Models;

use App\Models\User;
use App\Models\Partie;
use App\Models\Candidat;
use App\Models\TypeElection;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    use Sluggable;

    protected $guarded = [];
    
    //protected $fillable = ["name", "slug"];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function type_election(){
        return $this->belongsTo(TypeElection::class); 
    }

    public function candidats()
    {
        return $this->belongsToMany(Candidat::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vote')->withPivot('candidat_id');
    }
    
}

