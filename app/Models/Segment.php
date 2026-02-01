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
        'programme_id',
    ];

    /**
     * Get the bus that owns the segment.
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    /**
     * Get the programme that owns the segment.
     */
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
}