<?php

namespace App\Livewire\Discover;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Places extends Component
{
    public array $attractions = [];

    public function mount()
    {
        $cached = Cache::get('brasov_attractions');
        if ($cached) {
            $this->attractions = $cached;
            return;
        }

        $this->loadAttractions();
    }

    public function loadAttractions()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Goog-Api-Key' => config('services.google.places_api_key'),
            'X-Goog-FieldMask' => [
                'places.id',
                'places.displayName',
                'places.rating',
                'places.editorialSummary',
                'places.formattedAddress',
                'places.photos',
                'places.googleMapsLinks',
            ],
        ])->post('https://places.googleapis.com/v1/places:searchNearby', [
            'locationRestriction' => [
                'circle' => [
                    'center' => [
                        'latitude' => 45.6427,
                        'longitude' => 25.5887,
                    ],
                    'radius' => 20000,
                ]
            ],
            'includedTypes' => [
                'tourist_attraction',
                'art_gallery',
                'plaza',
                'opera_house',
                'arena',
                'museum',
            ],
            'excludedTypes' => ['hotel'],
            'languageCode' => 'en',
            'rankPreference' => 'POPULARITY',
            'maxResultCount' => 20,
        ]);

        $places = $response->json()['places'] ?? [];
        if (empty($places))
            return;


        $processed_places = array_map(function ($place) {
            $photoReference = $place['photos'][0]['name'] ?? null;

            return [
                'id' => $place['id'],
                'name' => $place['displayName']['text'] ?? 'Unknown',
                'address' => $place['formattedAddress'] ?? '',
                'rating' => $place['rating'] ?? 0,
                'place_link' => $place['googleMapsLinks']['placeUri'],
                'summary' => $place['editorialSummary']['text'] ?? '',
                'photo_url' => $photoReference ? $this->getPhotoUrl($photoReference) : null
            ];
        }, $places);

        $this->attractions = $processed_places;

        Cache::put('brasov_attractions', $processed_places, 1800);
    }

    public function render()
    {
        return view('livewire.discover.places');
    }

    private function getPhotoUrl($photoReference)
    {
        return "https://places.googleapis.com/v1/{$photoReference}/media?" . http_build_query([
            'key' => config('services.google.places_api_key'),
            'maxHeightPx' => 720,
            'maxWidthPx' => 1280
        ]);
    }
}
