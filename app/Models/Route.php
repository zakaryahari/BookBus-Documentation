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
     * Get the segments for the route.
     */
    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    /**
     * Get the programmes through segments.
     */
    public function programmes()
    {
        return $this->hasManyThrough(Programme::class, Segment::class);
    }

    /**
     * The gares that belong to the route through etapes.
     */
    public function gares()
    {
        return $this->belongsToMany(Gare::class, 'etapes');
    }
}