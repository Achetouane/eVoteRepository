<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Partie;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidat extends Model
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

    public function partie(){
        return $this->belongsTo(Partie::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Vote::class);
    }

 
}
