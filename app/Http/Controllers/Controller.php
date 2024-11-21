<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller
{
    public function getCityName(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');

        $coords = $this->getCoordinatesFromAddress($city);

        $locationLat = $coords['lat'] ?? 'Not found';
        $locationLng = $coords['lng'] ?? 'Not found';

        return view('welcome', compact('city','coords', 'locationLat', 'locationLng'));
    }

    public function getCoordinatesFromAddress($address)

{

    $apiKey = 'YOUR_GOOGLE_API_KEY'; 
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . $apiKey;
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
   if (!empty($data['results']) && isset($data['results'][0]['geometry']['location'])) {
        return [
            'lat' => (float) $data['results'][0]['geometry']['location']['lat'],
            'lng' => (float) $data['results'][0]['geometry']['location']['lng'],
            'formatted_address' => $data['results'][0]['formatted_address'], 
        ];
    }
    return null; 
}
}
