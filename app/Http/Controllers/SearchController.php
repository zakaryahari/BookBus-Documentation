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

        // Find segments that belong to routes connecting the departure and arrival cities
        $results = Segment::whereHas('route.etapes.gare', function($q) use ($request) {
                $q->where('ville_id', $request->departure_city);
            })
            ->whereHas('route.etapes.gare', function($q) use ($request) {
                $q->where('ville_id', $request->arrival_city);
            })
            ->whereHas('programmes')
            ->whereHas('bus', function($q) use ($request) {
                $q->where('capacite', '>=', $request->Passagers);
            })
            ->with(['bus', 'programmes', 'route.etapes.gare.ville', 'reservations'])
            ->get();

        return view('search-results', [
            'departureGares' => Gare::where('ville_id', $request->departure_city)->get(),
            'arrivalGares'   => Gare::where('ville_id', $request->arrival_city)->get(),
            'trajets'        => $results 
        ]);
    }
}
