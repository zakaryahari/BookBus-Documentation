<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'capacite',
        'statut',
    ];

    /**
     * Get the segments for the bus.
     */
    public function segments()
    {
        return $this->hasMany(Segment::class);
    }
}