<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche - SATAS-Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'satas-red': '#DC2626',
                        'satas-dark': '#374151',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/satas_logo.jpg') }}" alt="SATAS-Book" class="h-10 w-auto mr-3">
                </div>
                <div>
                    <a href="/" class="bg-satas-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        Search_page
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Summary -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-satas-dark">
                        {{ $departureGares->first()->ville->name ?? 'Ville de départ' }} → {{ $arrivalGares->first()->ville->name ?? 'Ville d\'arrivée' }}
                    </h1>
                    <p class="text-gray-600">{{ date('d F Y') }} • {{ request('Passagers', 1) }} Passager(s)</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button class="bg-gray-100 text-satas-dark px-4 py-2 rounded-lg hover:bg-gray-200 transition duration-300">
                        Modifier la recherche
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                    <h3 class="text-lg font-bold text-satas-dark mb-6">Filtres</h3>
                    
                    <!-- Class Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-satas-dark mb-3">Classe</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Standard</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Confort</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Premium</span>
                            </label>
                        </div>
                    </div>

                    <!-- Time Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-satas-dark mb-3">Horaire</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Matin (06h-12h)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Après-midi (12h-18h)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-satas-red focus:ring-satas-red">
                                <span class="ml-2 text-gray-700">Soir (18h-24h)</span>
                            </label>
                        </div>
                    </div>

                    <button class="w-full bg-satas-red text-white py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        Appliquer les filtres
                    </button>
                </div>
            </div>

            <!-- Results -->
            <div class="lg:w-3/4">
                <div class="mb-4">
                    <p class="text-gray-600">{{ count($trajets) }} résultat(s) trouvé(s)</p>
                </div>

                @if(count($trajets) > 0)
                    <div class="space-y-4">
                        @foreach($trajets as $trajet)
                            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-4">
                                            <div class="text-2xl font-bold text-satas-dark">
                                                {{ $trajet->programme->heure_depart ?? '06:00' }}
                                            </div>
                                            <div class="mx-4 flex-1">
                                                <div class="border-t-2 border-gray-300 relative">
                                                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 bg-gray-300 text-xs px-2 py-1 rounded">
                                                        {{ number_format($trajet->distance_km / 100, 1) }}h 
                                                        {{-- {{ (int)(($trajet->distance_km % 100) * 0.6) }}m --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-2xl font-bold text-satas-dark">
                                                {{ $trajet->programme->heure_arrivee ?? '12:30' }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4 mb-2">
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                {{ $trajet->programme->bus->statut ?? 'Standard' }}
                                            </span>
                                            <span class="text-green-600 font-medium">
                                                {{ $trajet->programme->bus->capacite - $trajet->reservations->sum('nombre_places') }} places restantes
                                            </span>
                                        </div>
                                        <div class="text-gray-600">
                                            Bus {{ $trajet->programme->bus->immatriculation }} • Capacité {{ $trajet->programme->bus->capacite }} places
                                        </div>
                                    </div>
                                    <div class="mt-4 md:mt-0 md:ml-6 flex flex-col space-y-2">
                                        <div class="text-right mb-2">
                                            <span class="text-3xl font-bold text-satas-dark">{{ number_format($trajet->tarif, 0) }} DH</span>
                                        </div>
                                        <a href="{{ route('booking.select', $trajet->id) }}" class="bg-satas-red text-white px-8 py-3 rounded-xl hover:bg-red-700 transition duration-300 font-bold text-center">
                                            Réserver
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <div class="text-6xl mb-4">🚌</div>
                        <h3 class="text-xl font-bold text-satas-dark mb-2">Aucun trajet trouvé</h3>
                        <p class="text-gray-600 mb-4">Désolé, aucun bus n'est disponible pour cette recherche.</p>
                        <button class="bg-satas-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                            Modifier la recherche
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-satas-dark text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <img src="{{ asset('images/satas_logo.jpg') }}" alt="SATAS-Book" class="h-12 w-auto mx-auto mb-4">
            <p class="text-gray-400">© 2026 SATAS-Book. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>