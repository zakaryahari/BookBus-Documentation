<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'segment_id',
        'jour_depart',
        'heure_depart',
        'heure_arrivee',
    ];

    /**
     * Get the segment that owns the programme.
     */
    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    /**
     * Get the route through the segment.
     */
    public function route()
    {
        return $this->hasOneThrough(Route::class, Segment::class, 'id', 'id', 'segment_id', 'route_id');
    }
}