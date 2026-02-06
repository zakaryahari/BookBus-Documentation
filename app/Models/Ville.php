<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the gares for the ville.
     */
    public function gares()
    {
        return $this->hasMany(Gare::class);
    }

    /**
     * Get the etapes through gares (shortcut for searching).
     */
    public function etapes()
    {
        return $this->hasManyThrough(Etape::class, Gare::class);
    }
}