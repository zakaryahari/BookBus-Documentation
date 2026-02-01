<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

    /**
     * Get the etapes for the route.
     */
    public function etapes()
    {
        return $this->hasMany(Etape::class);
    }

    /**
     * Get the programmes for the route.
     */
    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    /**
     * Get the segments for the route through programmes.
     */
    public function segments()
    {
        return $this->hasManyThrough(Segment::class, Programme::class);
    }

    /**
     * The gares that belong to the route.
     */
    public function gares()
    {
        return $this->belongsToMany(Gare::class, 'etapes');
    }
}