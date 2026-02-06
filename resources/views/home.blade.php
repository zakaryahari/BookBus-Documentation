<!DOCTYPE html><html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATAS-Book - Réservation de Bus</title>
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
                    {{-- <a href="/Search_page" class="bg-satas-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        Search_page
                    </a> --}}

                    @auth
                        {{-- <button class="bg-blue-500">Book This Trip</button> --}}
                        <p><a href="/profile">profile</a></p>
                    @endauth

                    @guest
                        <a href="/login">login</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-satas-red to-red-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    Voyagez en Toute Sérénité
                </h1>
                <p class="text-xl text-red-100">
                    Réservez votre billet de bus en quelques clics
                </p>
            </div>

            <!-- Search Form -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto">
                <form action="/Rechercher_Offer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6" method="POST">
                    @csrf
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-satas-dark mb-2">Ville de Départ</label>
                        <select name="departure_city" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-satas-red focus:border-transparent">
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-satas-dark mb-2">Ville d'Arrivée</label>
                        <select name="arrival_city" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-satas-red focus:border-transparent">
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-satas-dark mb-2">Date de Départ</label>
                        <input name="Start_Date" type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-satas-red focus:border-transparent" min="{{ date('Y-m-d') }}" >
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-satas-dark mb-2">Passagers</label>
                        <select name="Passagers" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-satas-red focus:border-transparent">
                            <option>1 Passager</option>
                            <option>2 Passagers</option>
                            <option>3 Passagers</option>
                            <option>4 Passagers</option>
                            <option>5+ Passagers</option>
                        </select>
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-transparent mb-2">.</label>
                        <button type="submit" class="w-full bg-satas-red text-white p-3 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-satas-dark mb-4">Offres Spéciales</h2>
                <p class="text-gray-600">Découvrez nos meilleures destinations aux prix les plus avantageux</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Offer 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                        <div class="text-white text-center">
                            <div class="text-4xl mb-2">🏙️</div>
                            <div class="text-lg font-semibold">Casablanca → Marrakech</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-satas-dark">Casablanca → Marrakech</h3>
                                <p class="text-gray-600">3h 30min de voyage</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-satas-red">70 DH</div>
                                <div class="text-sm text-gray-500">À partir de</div>
                            </div>
                        </div>
                        <button class="w-full bg-satas-red text-white py-3 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                            Réserver Maintenant
                        </button>
                    </div>
                </div>

                <!-- Offer 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-orange-400 to-orange-600 flex items-center justify-center">
                        <div class="text-white text-center">
                            <div class="text-4xl mb-2">🏜️</div>
                            <div class="text-lg font-semibold">Agadir → Dakhla</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-satas-dark">Agadir → Dakhla</h3>
                                <p class="text-gray-600">8h 45min de voyage</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-satas-red">250 DH</div>
                                <div class="text-sm text-gray-500">À partir de</div>
                            </div>
                        </div>
                        <button class="w-full bg-satas-red text-white py-3 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                            Réserver Maintenant
                        </button>
                    </div>
                </div>

                <!-- Offer 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                        <div class="text-white text-center">
                            <div class="text-4xl mb-2">🌊</div>
                            <div class="text-lg font-semibold">Rabat → Tanger</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-satas-dark">Rabat → Tanger</h3>
                                <p class="text-gray-600">4h 15min de voyage</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-satas-red">100 DH</div>
                                <div class="text-sm text-gray-500">À partir de</div>
                            </div>
                        </div>
                        <button class="w-full bg-satas-red text-white py-3 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                            Réserver Maintenant
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-satas-dark text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
             <img src="{{ asset('images/satas_logo.jpg') }}" alt="SATAS-Book" class="h-12 w-auto mx-auto mb-4">
           <p class="text-gray-400">© 2026 SATAS-Book. Tous droits réservés.</p>
        </div>
    </footer>
{{-- a> --}} 
    </fieldset>
</body>
</html>