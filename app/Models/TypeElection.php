<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeElection extends Model
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

    public function votes()
    { 
        return $this->hasMany(Vote::class); 
    }
    
}
