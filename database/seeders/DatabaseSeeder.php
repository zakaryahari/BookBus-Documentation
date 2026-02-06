<?php

namespace Database\Seeders;

use App\Models\{User, Client, Admin, Ville, Gare, Route, Etape, Bus, Programme, Segment};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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
        $villes = ['Dakhla', 'Agadir', 'Marrakech', 'Casablanca', 'Rabat'];
        foreach ($villes as $villeName) {
            Ville::create(['name' => $villeName]);
        }

        // Create Gares
        $gares = [
            ['nom' => 'Gare Routière Dakhla', 'adresse' => 'Avenue Hassan II, Dakhla', 'ville_id' => 1],
            ['nom' => 'Gare Routière Agadir', 'adresse' => 'Boulevard Mohammed V, Agadir', 'ville_id' => 2],
            ['nom' => 'Gare Routière Marrakech', 'adresse' => 'Bab Doukkala, Marrakech', 'ville_id' => 3],
            ['nom' => 'Gare Routière Casa', 'adresse' => 'Ouled Ziane, Casablanca', 'ville_id' => 4],
            ['nom' => 'Gare Routière Rabat', 'adresse' => 'Kamra, Rabat', 'ville_id' => 5],
        ];
        foreach ($gares as $gare) {
            Gare::create($gare);
        }

        // Create Routes with Etapes
        $routes = [
            [
                'nom' => 'Ligne Sahara-Souss',
                'description' => 'Liaison directe Dakhla-Agadir',
                'etapes' => [
                    ['gare_id' => 1, 'ordre' => 1, 'heure_passage' => '06:00:00'],
                    ['gare_id' => 2, 'ordre' => 2, 'heure_passage' => '14:00:00'],
                ]
            ],
            [
                'nom' => 'Ligne Atlas Express',
                'description' => 'Liaison Agadir-Marrakech',
                'etapes' => [
                    ['gare_id' => 2, 'ordre' => 1, 'heure_passage' => '08:00:00'],
                    ['gare_id' => 3, 'ordre' => 2, 'heure_passage' => '12:00:00'],
                ]
            ],
            [
                'nom' => 'Ligne Côte Atlantique',
                'description' => 'Casablanca-Agadir',
                'etapes' => [
                    ['gare_id' => 4, 'ordre' => 1, 'heure_passage' => '07:00:00'],
                    ['gare_id' => 2, 'ordre' => 2, 'heure_passage' => '12:00:00'],
                ]
            ]
        ];

        $createdRoutes = [];
        foreach ($routes as $routeData) {
            $route = Route::create([
                'nom' => $routeData['nom'],
                'description' => $routeData['description']
            ]);
            
            $etapes = [];
            foreach ($routeData['etapes'] as $etapeData) {
                $etapes[] = Etape::create([
                    'route_id' => $route->id,
                    'gare_id' => $etapeData['gare_id'],
                    'ordre' => $etapeData['ordre'],
                    'heure_passage' => $etapeData['heure_passage']
                ]);
            }
            
            $createdRoutes[] = ['route' => $route, 'etapes' => $etapes];
        }

        // Create Buses
        Bus::factory(5)->create();

        // Create Programmes and Segments
        $programmeData = [
            ['route_id' => 1, 'bus_id' => 1, 'jour_depart' => 'Lundi', 'heure_depart' => '06:00:00', 'heure_arrivee' => '14:00:00'],
            ['route_id' => 1, 'bus_id' => 2, 'jour_depart' => 'Mardi', 'heure_depart' => '06:00:00', 'heure_arrivee' => '14:00:00'],
            ['route_id' => 2, 'bus_id' => 3, 'jour_depart' => 'Mercredi', 'heure_depart' => '08:00:00', 'heure_arrivee' => '12:00:00'],
            ['route_id' => 2, 'bus_id' => 4, 'jour_depart' => 'Jeudi', 'heure_depart' => '08:00:00', 'heure_arrivee' => '12:00:00'],
            ['route_id' => 3, 'bus_id' => 5, 'jour_depart' => 'Vendredi', 'heure_depart' => '07:00:00', 'heure_arrivee' => '12:00:00'],
        ];

        foreach ($programmeData as $progData) {
            $programme = Programme::create($progData);
            
            // Find etapes for this route
            $routeEtapes = $createdRoutes[$progData['route_id'] - 1]['etapes'];
            $departEtape = $routeEtapes[0];
            $arriveEtape = $routeEtapes[1];
            
            // Create segment with depart and arrive etapes
            Segment::create([
                'programme_id' => $programme->id,
                'depart_etape_id' => $departEtape->id,
                'arrive_etape_id' => $arriveEtape->id,
                'tarif' => rand(75, 250),
                'distance_km' => rand(200, 800),
            ]);
        }
    }
}