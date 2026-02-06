<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use App\Models\Ville;
use App\Models\Segment;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function index() {
        return view('home' , 
            ['villes' => Ville::all()]
        );
    }

    public function search(Request $request) {
        $request->validate([
            'departure_city' => 'required|exists:villes,id',
            'arrival_city'   => 'required|exists:villes,id|different:departure_city',
            'Start_Date' => 'required|date|after_or_equal:today',
            'Passagers' => 'required'
        ]);

        // Find segments using the new depart_etape_id and arrive_etape_id structure
        $results = Segment::whereHas('departEtape.gare', function($q) use ($request) {
                $q->where('ville_id', $request->departure_city);
            })
            ->whereHas('arriveEtape.gare', function($q) use ($request) {
                $q->where('ville_id', $request->arrival_city);
            })
            ->whereHas('programme.bus', function($q) use ($request) {
                $q->where('capacite', '>=', $request->Passagers);
            })
            ->with(['programme.bus', 'programme', 'departEtape.gare.ville', 'arriveEtape.gare.ville', 'reservations'])
            ->get();

        return view('search-results', [
            'departureGares' => Gare::where('ville_id', $request->departure_city)->get(),
            'arrivalGares'   => Gare::where('ville_id', $request->arrival_city)->get(),
            'trajets'        => $results 
        ]);
    }
}
