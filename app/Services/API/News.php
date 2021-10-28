<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;

class News implements NewsInterface
{
    /**
     * Update News from API
     * @return mixed
     */
    public function updateNews(){
        $date = date('Y-m-d');

        $apiRequest = Http::get('https://newsapi.org/v2/everything', [
            'from' => $date,
            'to' => $date,
            'sortBy' => 'popularity',
            'apiKey' => env('NEWS_API_KEY', true),
            'q' => 'CRON'
        ]);

        $response = json_decode($apiRequest->getBody());

        dd($response);
    }

}
