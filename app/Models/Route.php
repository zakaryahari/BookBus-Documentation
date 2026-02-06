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

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

}