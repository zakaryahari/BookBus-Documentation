<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Reservation;
use App\Models\Client;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function selectTrip($segmentId)
    {
        session(['selected_segment_id' => $segmentId]);
        
        return redirect()->route('booking.form');
    }

    public function showForm()
    {
        $segmentId = session('selected_segment_id');
        
        if (!$segmentId) {
            return redirect('/')->with('error', 'Veuillez sélectionner un trajet');
        }

        $segment = Segment::find($segmentId);
        
        if (!$segment) {
            return redirect('/')->with('error', 'Trajet introuvable');
        }

        $segment->load('programme.bus', 'departEtape.gare.ville', 'arriveEtape.gare.ville');

        return view('booking.form', ['segment' => $segment]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_places' => 'required|integer|min:1|max:4',
            'passengers' => 'required|array',
            'passengers.*.nom' => 'required|string|max:255',
            'passengers.*.prenom' => 'required|string|max:255',
            'passengers.*.cin' => 'required|string|max:20',
        ]);

        $segmentId = session('selected_segment_id');
        $segment = Segment::find($segmentId);

        $client = Client::where('user_id', auth()->id())->first();

        if (!$client) {
            $client = Client::create([
                'user_id' => auth()->id(),
                'phone' => $request->phone ?? null,
            ]);
        }

        $prixTotal = $segment->tarif * $validated['nombre_places'];

        $reservation = Reservation::create([
            'client_id' => $client->id,
            'segment_id' => $segment->id,
            'nombre_places' => $validated['nombre_places'],
            'prix_total' => $prixTotal,
            'statut' => 'en_attente',
        ]);

        session()->forget('selected_segment_id');

        return redirect()->route('booking.confirmation', $reservation->id)
            ->with('success', 'Réservation créée avec succès!');
    }

    public function confirmation($reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if (!$reservation || $reservation->client->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Réservation introuvable');
        }

        $reservation->load('segment.programme.bus', 'segment.departEtape.gare.ville', 'segment.arriveEtape.gare.ville');

        return view('booking.confirmation', ['reservation' => $reservation]);
    }
}
