<?php

namespace Database\Seeders;

use App\Models\{User, Client, Admin, Ville, Gare, Route, Etape, Bus, Programme, Segment, Reservation};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin BookBus',
            'email' => 'admin@bookbus.ma',
        ]);
        Admin::create([
            'user_id' => $adminUser->id,
            'admin_level' => 'super_admin',
        ]);

        $clientUsers = User::factory(20)->create();
        foreach ($clientUsers as $user) {
            Client::create([
                'user_id' => $user->id,
                'phone' => '06' . rand(10000000, 99999999),
            ]);
        }

        $villes = [
            'Dakhla', 'Agadir', 'Marrakech', 'Casablanca', 'Rabat',
            'Fès', 'Tanger', 'Meknès', 'Oujda', 'Essaouira',
            'Tétouan', 'Laâyoune', 'Nador', 'Kénitra', 'Béni Mellal'
        ];
        
        foreach ($villes as $villeName) {
            Ville::create(['name' => $villeName]);
        }

        $gares = [
            ['nom' => 'Gare Routière Dakhla', 'adresse' => 'Avenue Hassan II, Dakhla', 'ville_id' => 1],
            ['nom' => 'Gare Routière Agadir', 'adresse' => 'Boulevard Mohammed V, Agadir', 'ville_id' => 2],
            ['nom' => 'Gare CTM Agadir', 'adresse' => 'Rue de la Poste, Agadir', 'ville_id' => 2],
            ['nom' => 'Gare Routière Marrakech', 'adresse' => 'Bab Doukkala, Marrakech', 'ville_id' => 3],
            ['nom' => 'Gare CTM Marrakech', 'adresse' => 'Avenue Hassan II, Marrakech', 'ville_id' => 3],
            ['nom' => 'Gare Routière Casa', 'adresse' => 'Ouled Ziane, Casablanca', 'ville_id' => 4],
            ['nom' => 'Gare CTM Casa', 'adresse' => 'Rue Léon l\'Africain, Casablanca', 'ville_id' => 4],
            ['nom' => 'Gare Routière Rabat', 'adresse' => 'Kamra, Rabat', 'ville_id' => 5],
            ['nom' => 'Gare Routière Fès', 'adresse' => 'Route d\'Imouzzer, Fès', 'ville_id' => 6],
            ['nom' => 'Gare Routière Tanger', 'adresse' => 'Place Jamia Al Arabia, Tanger', 'ville_id' => 7],
            ['nom' => 'Gare Routière Meknès', 'adresse' => 'Avenue des FAR, Meknès', 'ville_id' => 8],
            ['nom' => 'Gare Routière Oujda', 'adresse' => 'Boulevard Zerktouni, Oujda', 'ville_id' => 9],
            ['nom' => 'Gare Routière Essaouira', 'adresse' => 'Avenue Lalla Aicha, Essaouira', 'ville_id' => 10],
            ['nom' => 'Gare Routière Tétouan', 'adresse' => 'Avenue Youssef Ben Tachfine, Tétouan', 'ville_id' => 11],
            ['nom' => 'Gare Routière Laâyoune', 'adresse' => 'Avenue Mekka, Laâyoune', 'ville_id' => 12],
        ];
        
        foreach ($gares as $gare) {
            Gare::create($gare);
        }

        $routes = [
            ['nom' => 'Ligne Sahara Express', 'description' => 'Dakhla-Agadir', 'etapes' => [
                ['gare_id' => 1, 'ordre' => 1, 'heure_passage' => '06:00:00'],
                ['gare_id' => 2, 'ordre' => 2, 'heure_passage' => '14:00:00'],
            ]],
            ['nom' => 'Ligne Atlas', 'description' => 'Agadir-Marrakech', 'etapes' => [
                ['gare_id' => 2, 'ordre' => 1, 'heure_passage' => '08:00:00'],
                ['gare_id' => 4, 'ordre' => 2, 'heure_passage' => '12:00:00'],
            ]],
            ['nom' => 'Ligne Côte Atlantique', 'description' => 'Casablanca-Agadir', 'etapes' => [
                ['gare_id' => 6, 'ordre' => 1, 'heure_passage' => '07:00:00'],
                ['gare_id' => 2, 'ordre' => 2, 'heure_passage' => '12:00:00'],
            ]],
            ['nom' => 'Ligne Impériale', 'description' => 'Rabat-Marrakech', 'etapes' => [
                ['gare_id' => 8, 'ordre' => 1, 'heure_passage' => '09:00:00'],
                ['gare_id' => 4, 'ordre' => 2, 'heure_passage' => '13:00:00'],
            ]],
            ['nom' => 'Ligne Royale', 'description' => 'Casablanca-Rabat', 'etapes' => [
                ['gare_id' => 6, 'ordre' => 1, 'heure_passage' => '06:00:00'],
                ['gare_id' => 8, 'ordre' => 2, 'heure_passage' => '07:30:00'],
            ]],
            ['nom' => 'Ligne Méditerranée', 'description' => 'Tanger-Tétouan', 'etapes' => [
                ['gare_id' => 10, 'ordre' => 1, 'heure_passage' => '08:00:00'],
                ['gare_id' => 14, 'ordre' => 2, 'heure_passage' => '09:30:00'],
            ]],
            ['nom' => 'Ligne Orientale', 'description' => 'Fès-Oujda', 'etapes' => [
                ['gare_id' => 9, 'ordre' => 1, 'heure_passage' => '10:00:00'],
                ['gare_id' => 12, 'ordre' => 2, 'heure_passage' => '14:00:00'],
            ]],
            ['nom' => 'Ligne Perle', 'description' => 'Marrakech-Essaouira', 'etapes' => [
                ['gare_id' => 4, 'ordre' => 1, 'heure_passage' => '07:00:00'],
                ['gare_id' => 13, 'ordre' => 2, 'heure_passage' => '10:00:00'],
            ]],
            ['nom' => 'Ligne Capitale', 'description' => 'Rabat-Fès', 'etapes' => [
                ['gare_id' => 8, 'ordre' => 1, 'heure_passage' => '08:00:00'],
                ['gare_id' => 9, 'ordre' => 2, 'heure_passage' => '11:00:00'],
            ]],
            ['nom' => 'Ligne Grand Sud', 'description' => 'Dakhla-Marrakech', 'etapes' => [
                ['gare_id' => 1, 'ordre' => 1, 'heure_passage' => '05:00:00'],
                ['gare_id' => 4, 'ordre' => 2, 'heure_passage' => '19:00:00'],
            ]],
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

        Bus::factory(30)->create();

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $heures = [
            ['06:00:00', '10:00:00'], ['07:00:00', '11:00:00'], ['08:00:00', '12:00:00'],
            ['09:00:00', '13:00:00'], ['10:00:00', '14:00:00'], ['11:00:00', '15:00:00'],
            ['12:00:00', '16:00:00'], ['14:00:00', '18:00:00'], ['15:00:00', '19:00:00'],
            ['16:00:00', '20:00:00'], ['18:00:00', '22:00:00'], ['20:00:00', '02:00:00'],
        ];

        $tarifs = [45, 55, 65, 75, 85, 95, 110, 120, 140, 160, 180, 200, 220, 250, 280, 300];

        $segmentCount = 0;
        $busIndex = 1;

        foreach ($createdRoutes as $routeIndex => $routeData) {
            $route = $routeData['route'];
            $etapes = $routeData['etapes'];
            
            foreach ($jours as $jour) {
                $programmesPerDay = rand(2, 4);
                
                for ($p = 0; $p < $programmesPerDay; $p++) {
                    $heureSet = $heures[array_rand($heures)];
                    
                    $programme = Programme::create([
                        'route_id' => $route->id,
                        'bus_id' => $busIndex,
                        'jour_depart' => $jour,
                        'heure_depart' => $heureSet[0],
                        'heure_arrivee' => $heureSet[1],
                    ]);

                    $tarif = $tarifs[array_rand($tarifs)];
                    $distance = rand(50, 900);

                    $segment = Segment::create([
                        'programme_id' => $programme->id,
                        'depart_etape_id' => $etapes[0]->id,
                        'arrive_etape_id' => $etapes[1]->id,
                        'tarif' => $tarif,
                        'distance_km' => $distance,
                    ]);

                    $segmentCount++;
                    $busIndex = ($busIndex % 30) + 1;

                    if ($segmentCount >= 60) break 3;
                }
            }
        }

        $clients = Client::all();
        $segments = Segment::all();
        $statuts = ['confirmee', 'en_attente', 'annulee'];

        for ($i = 0; $i < 80; $i++) {
            $client = $clients->random();
            $segment = $segments->random();
            $nombrePlaces = rand(1, 4);
            
            Reservation::create([
                'client_id' => $client->id,
                'segment_id' => $segment->id,
                'nombre_places' => $nombrePlaces,
                'prix_total' => $segment->tarif * $nombrePlaces,
                'statut' => $statuts[array_rand($statuts)],
            ]);
        }
    }
}
