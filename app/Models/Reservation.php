<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'segment_id',
        'nombre_places',
        'prix_total',
        'statut',
    ];

    /**
     * Get the client that owns the reservation.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the segment that owns the reservation.
     */
    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }
}