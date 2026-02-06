<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gare extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'ville_id',
    ];

    /**
     * Get the ville that owns the gare.
     */
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    /**
     * The routes that belong to the gare.
     */
    public function etape()
    {
        return $this->hasMany(Etape::class);
    }
}