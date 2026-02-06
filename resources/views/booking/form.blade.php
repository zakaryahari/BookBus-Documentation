<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Réservation de billet
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Détails du voyage</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">
                                <strong>Départ:</strong> {{ $segment->departEtape->gare->ville->name }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Arrivée:</strong> {{ $segment->arriveEtape->gare->ville->name }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Heure:</strong> {{ $segment->programme->heure_depart }} → {{ $segment->programme->heure_arrivee }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-red-600">{{ number_format($segment->tarif, 0) }} DH</p>
                            <p class="text-gray-600">par passager</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de passagers</label>
                            <select name="nombre_places" id="nombre_places" class="w-full border-gray-300 rounded-lg" onchange="updatePassengers()">
                                <option value="1">1 Passager</option>
                                <option value="2">2 Passagers</option>
                                <option value="3">3 Passagers</option>
                                <option value="4">4 Passagers</option>
                            </select>
                        </div>

                        <div id="passengers-container">
                            @for($i = 0; $i < 1; $i++)
                                <div class="passenger-form border-t pt-4 mt-4">
                                    <h4 class="font-semibold text-gray-900 mb-3">Passager {{ $i + 1 }}</h4>
                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                            <input type="text" name="passengers[{{ $i }}][nom]" required class="w-full border-gray-300 rounded-lg">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                            <input type="text" name="passengers[{{ $i }}][prenom]" required class="w-full border-gray-300 rounded-lg">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">CIN</label>
                                            <input type="text" name="passengers[{{ $i }}][cin]" required class="w-full border-gray-300 rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-700">Prix total:</span>
                                <span class="text-2xl font-bold text-red-600" id="total-price">{{ number_format($segment->tarif, 0) }} DH</span>
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 font-bold">
                                Confirmer la réservation
                            </button>
                            <a href="/" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 font-bold text-center">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const tarif = {{ $segment->tarif }};
        
        function updatePassengers() {
            const count = parseInt(document.getElementById('nombre_places').value);
            const container = document.getElementById('passengers-container');
            container.innerHTML = '';
            
            for(let i = 0; i < count; i++) {
                container.innerHTML += `
                    <div class="passenger-form border-t pt-4 mt-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Passager ${i + 1}</h4>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" name="passengers[${i}][nom]" required class="w-full border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" name="passengers[${i}][prenom]" required class="w-full border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">CIN</label>
                                <input type="text" name="passengers[${i}][cin]" required class="w-full border-gray-300 rounded-lg">
                            </div>
                        </div>
                    </div>
                `;
            }
            
            document.getElementById('total-price').textContent = (tarif * count).toLocaleString() + ' DH';
        }
    </script>
</x-app-layout>
