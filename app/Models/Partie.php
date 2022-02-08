<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partie extends Model
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


    public function candidats()
    { 
        return $this->hasMany(Candidat::class); 
    }
}
