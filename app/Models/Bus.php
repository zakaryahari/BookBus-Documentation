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
     * Get the segment for the bus (1-to-1).
     */
    public function segment()
    {
        return $this->hasOne(Segment::class);
    }
}