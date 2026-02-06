<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tarif',
        'distance_km',
        'bus_id',
        'route_id',
    ];

    /**
     * Get the bus that owns the segment (1-to-1).
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    /**
     * Get the route that owns the segment.
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Get the programme that owns the segment.
     */
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    /**
     * Get the reservations for the segment.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function departEtape() { 
        return $this->belongsTo(Etape::class, 'depart_etape_id'); 
    }

    public function arriveEtape() { 
        return $this->belongsTo(Etape::class, 'arrive_etape_id'); 
    }
}