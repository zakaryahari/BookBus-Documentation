<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Confirmation de réservation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <svg class="w-12 h-12 text-green-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-green-800">Réservation confirmée!</h3>
                        <p class="text-green-700">Votre réservation a été enregistrée avec succès.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Détails de la réservation</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Numéro de réservation:</span>
                            <span class="font-semibold">#{{ $reservation->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Départ:</span>
                            <span class="font-semibold">{{ $reservation->segment->departEtape->gare->ville->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Arrivée:</span>
                            <span class="font-semibold">{{ $reservation->segment->arriveEtape->gare->ville->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Heure de départ:</span>
                            <span class="font-semibold">{{ $reservation->segment->programme->heure_depart }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Heure d'arrivée:</span>
                            <span class="font-semibold">{{ $reservation->segment->programme->heure_arrivee }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bus:</span>
                            <span class="font-semibold">{{ $reservation->segment->programme->bus->immatriculation }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nombre de places:</span>
                            <span class="font-semibold">{{ $reservation->nombre_places }}</span>
                        </div>
                        <div class="flex justify-between border-t pt-3 mt-3">
                            <span class="text-lg font-bold text-gray-900">Prix total:</span>
                            <span class="text-2xl font-bold text-red-600">{{ number_format($reservation->prix_total, 0) }} DH</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Statut:</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4">
                <a href="/" class="flex-1 bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 font-bold text-center">
                    Retour à l'accueil
                </a>
                <a href="/dashboard" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 font-bold text-center">
                    Mes réservations
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
