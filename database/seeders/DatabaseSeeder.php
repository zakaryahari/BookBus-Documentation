<?php

namespace Database\Seeders;

use App\Models\{User, Client, Admin, Ville, Gare, Route, Etape, Bus, Programme, Segment};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin BookBus',
            'email' => 'admin@bookbus.ma',
        ]);
        Admin::create([
            'user_id' => $adminUser->id,
            'admin_level' => 'super_admin',
        ]);

        // Create 10 Clients
        Client::factory(10)->create();

        // Create Moroccan cities
        $villes = [
            'Dakhla', 'Agadir', 'Marrakech', 'Casablanca', 'Rabat', 
            'Fès', 'Tanger', 'Meknès', 'Oujda', 'Tétouan'
        ];
        
        foreach ($villes as $villeName) {
            Ville::create(['name' => $villeName]);
        }

        // Create Gares (some cities have multiple stations)
        $gares = [
            ['nom' => 'Gare Routière Dakhla', 'adresse' => 'Avenue Hassan II, Dakhla', 'ville_id' => 1],
            ['nom' => 'Gare Routière Agadir', 'adresse' => 'Boulevard Mohammed V, Agadir', 'ville_id' => 2],
            ['nom' => 'Gare CTM Agadir', 'adresse' => 'Rue de la Poste, Agadir', 'ville_id' => 2],
            ['nom' => 'Gare Routière Marrakech', 'adresse' => 'Bab Doukkala, Marrakech', 'ville_id' => 3],
            ['nom' => 'Gare CTM Marrakech', 'adresse' => 'Avenue Hassan II, Marrakech', 'ville_id' => 3],
            ['nom' => 'Gare Routière Casa', 'adresse' => 'Ouled Ziane, Casablanca', 'ville_id' => 4],
            ['nom' => 'Gare Routière Rabat', 'adresse' => 'Kamra, Rabat', 'ville_id' => 5],
        ];
        
        foreach ($gares as $gare) {
            Gare::create($gare);
        }

        // Create Route 'Ligne Sahara-Souss'
        $route = Route::create([
            'nom' => 'Ligne Sahara-Souss',
            'description' => 'Liaison entre Dakhla, Agadir et Marrakech via les principales villes du Sud'
        ]);

        // Create Etapes for the route
        $etapes = [
            ['route_id' => $route->id, 'gare_id' => 1, 'ordre' => 1, 'heure_passage' => '06:00:00'], // Dakhla
            ['route_id' => $route->id, 'gare_id' => 2, 'ordre' => 2, 'heure_passage' => '14:00:00'], // Agadir
            ['route_id' => $route->id, 'gare_id' => 4, 'ordre' => 3, 'heure_passage' => '18:00:00'], // Marrakech
        ];
        
        foreach ($etapes as $etape) {
            Etape::create($etape);
        }

        // Create 5 Buses
        Bus::factory(5)->create();

        // Create Segments for the 'Ligne Sahara-Souss' with realistic prices and distances
        $segments = [
            ['route_id' => $route->id, 'bus_id' => 1, 'tarif' => 200.00, 'distance_km' => 650.0], // Dakhla-Agadir
            ['route_id' => $route->id, 'bus_id' => 2, 'tarif' => 80.00, 'distance_km' => 250.0],  // Agadir-Marrakech
            ['route_id' => $route->id, 'bus_id' => 3, 'tarif' => 280.00, 'distance_km' => 900.0], // Dakhla-Marrakech
        ];
        
        foreach ($segments as $segmentData) {
            $segment = Segment::create($segmentData);
            
            // Create Programme for each segment
            Programme::create([
                'segment_id' => $segment->id,
                'jour_depart' => 'Lundi',
                'heure_depart' => '06:00:00',
                'heure_arrivee' => '18:00:00',
            ]);
        }
    }
}
